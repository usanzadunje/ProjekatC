<template>
  <div class="flex justify-center items-center">
    <div class="w-1/2 rounded-xl p-10">
      <h2 class="text-4xl font-medium text-center">
        {{ place?.reservation ? `Edit reservation at ${place.name}` : `Create new reservation at ${place.name}` }}
      </h2>
      <form
          @submit.prevent="storeOrUpdateReservation"
          class="px-16 mt-16"
      >
        <AppInput
            :required="true"
            label="Occasion"
            type="text"
            :autofocus="true"
            v-model="form.occasion"
            :error="form.errors.occasion"
            placeholder="Reservation occasion..."
            class="mt-8"
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
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted, PropType, toRefs } from 'vue';
import { useForm }                                      from '@inertiajs/inertia-vue3';
import route                                            from 'ziggy';

import Layout           from '@/Shared/Layout.vue';
import AppInput         from '@/Shared/AppInput.vue';
import AppTextarea      from '@/Shared/AppTextarea.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';
import { Place }        from '@/types';

export default defineComponent({
  name: 'Reservations/Regular/CreateEdit',
  components: {
    AppInput,
    AppTextarea,
    AppLoadingButton,
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
    });

    /* Lifecycle hooks */
    onMounted(() => {
      const placeInternal: Place = place.value as Place;

      if(placeInternal?.reservation) {
        form.reservation_date = placeInternal.reservation.reservation_date;
        form.occasion = placeInternal.reservation.occasion as string;
        form.number_of_guests = placeInternal.reservation.number_of_guests as number;
        form.additional_requirements = placeInternal.reservation.additional_requirements as string;
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
    };
  },
});

</script>