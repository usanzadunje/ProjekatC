<template>
  <div class="">
    <h2 class="mt-10 text-4xl font-medium text-center">
      {{ place?.reservation ? `Edit reservation at ${place.name}` : `Create new reservation at ${place.name}` }}
    </h2>
    <div class="flex mt-16">
      <div class="w-1/2 px-16 mt-2">
        <form
            @submit.prevent="storeOrUpdateReservation"
        >
          <AppInput
              :required="true"
              label="Occasion"
              type="text"
              :autofocus="true"
              v-model="form.occasion"
              :error="form.errors.occasion"
              placeholder="Reservation occasion..."
              @focus="form.clearErrors('occasion')"
          />
          <AppInput
              :required="true"
              label="Number of guests"
              type="number"
              v-model.number="form.number_of_guests"
              :error="form.errors.number_of_guests"
              placeholder="Number of guests..."
              class="mt-4"
              @focus="form.clearErrors('number_of_guests')"
          />
          <AppTextarea
              label="Additional requirements"
              type="text"
              v-model="form.additional_requirements"
              :error="form.errors.additional_requirements"
              placeholder="Your custom requirements..."
              class="mt-4"
              :rows="10"
              @focus="form.clearErrors('additional_requirements')"
          />
          <AppLoadingButton
              :loading="form.processing"
              class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-12 py-3 px-6 text-white font-medium"
          >
            {{ place?.reservation ? 'Update' : 'Create' }}
          </AppLoadingButton>
        </form>
      </div>
      <div class="w-1/2 px-16">
        <div class="">
          {{ form.reservation_date }}
          <Datepicker
              ref="date"
              v-model="form.reservation_date" autoApply
              :enableTimePicker="false"
          >
            <template #trigger>
              <div class="bg-white rounded-md px-8 py-4 text-xl">
                {{ dayjs(form.reservation_date).format('dddd DD MMMM YYYY') }}
              </div>
            </template>
          </Datepicker>
        </div>
        <div class="mt-8">
          <h2 class="text-3xl text-center">Offers</h2>
          <div class="flex justify-center items-center gap-4 flex-wrap mt-10">
            <div
                v-for="offer in place.offers"
                :key="offer.id"
                class="py-2 px-8 rounded-full cursor-pointer"
                :class="[form.offers.includes(offer.id) ?
              'opacity-100 bg-primary-600 text-white' :
              'bg-primary-100 hover:opacity-100 hover:bg-primary-600 hover:text-white'
              ]"
                @click="addOrRemoveFromArray(form.offers, offer.id)"
            >
              {{ offer.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, PropType, toRefs } from 'vue';
import { useForm }                                      from '@inertiajs/inertia-vue3';
import route                                            from 'ziggy';
import dayjs                                            from 'dayjs';

import Layout           from '@/Shared/Layout.vue';
import AppInput         from '@/Shared/AppInput.vue';
import AppTextarea      from '@/Shared/AppTextarea.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';
import Datepicker       from 'vue3-date-time-picker';
import 'vue3-date-time-picker/dist/main.css';

import { addOrRemoveFromArray, pluckFromArray } from '@/utils/helpers';

import { Place, Offer } from '@/types';

export default defineComponent({
  name: 'Reservations/Regular/CreateEdit',
  components: {
    AppInput,
    AppTextarea,
    AppLoadingButton,
    Datepicker,
  },
  layout: Layout,
  props: {
    place: {
      type: Object as PropType<Place | null>,
      required: false,
    },
  },
  setup(props) {
    /* Component properties */
    const { place } = toRefs(props);
    const form = useForm({
      place_id: props.place?.id,
      reservation_date: new Date().toISOString(),
      occasion: '',
      number_of_guests: NaN,
      additional_requirements: '',
      offers: [] as number[],
    });

    /* Lifecycle hooks */
    onMounted(() => {
      const placeInternal: Place = place.value as Place;

      if(placeInternal?.reservation) {
        form.reservation_date = placeInternal.reservation.reservation_date;
        form.occasion = placeInternal.reservation.occasion as string;
        form.number_of_guests = placeInternal.reservation.number_of_guests as number;
        form.additional_requirements = placeInternal.reservation.additional_requirements as string;
        form.offers = pluckFromArray(placeInternal.reservation.offers as Offer[], 'id');
      }
    });

    /* Event handlers */
    const storeOrUpdateReservation = (): void => {
      const placeInternal: Place = place.value as Place;

      if(placeInternal?.reservation) {
        form.patch(route('regular.reservation.update', placeInternal.reservation.id), {
          preserveState: true,
          only: ['errors', 'flash'],
        });
      }else {
        form.post(route('regular.reservation.store'), {
          preserveState: true,
          only: ['errors', 'flash'],
        });
      }
    };

    return {
      /* Component properties */
      form,

      /* Event handlers */
      storeOrUpdateReservation,
      addOrRemoveFromArray,

      /* Helpers */
      dayjs,
    };
  },
});

</script>
<style>
.dp__theme_light {
  --dp-hover-color: #DCDEFE;
  --dp-primary-color: #5139EF;
  --dp-border-color: none;
}
</style>
