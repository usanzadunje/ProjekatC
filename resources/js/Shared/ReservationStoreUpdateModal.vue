<template>
  <div class="h-78 bg-primary-paint-300 rounded-xl p-10">
    <h2 class="text-3xl text-center">
      {{ place.reservation ? `Edit reservation at ${place.name}` : `Create new reservation at ${place.name}` }}
    </h2>
    <form
        @submit.prevent="storeOrUpdateReservation"
        class="px-16"
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
          v-model="form.number_of_guests"
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
          :rows="5"
          @focus="form.clearErrors('additional_requirements')"
      />
      <AppLoadingButton
          :loading="form.processing"
          class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-12 py-3 px-6 text-white font-medium"
      >
        {{ place.reservation ? 'Update' : 'Create' }}
      </AppLoadingButton>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { useForm }                   from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppInput         from '@/Shared/AppInput.vue';
import AppTextarea      from '@/Shared/AppTextarea.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'ReservationStoreUpdateModal',
  props: {
    place: {
      type: Object as PropType<Place | null>,
      required: false,
    },
  },
  components: {
    AppInput,
    AppTextarea,
    AppLoadingButton,
  },
  emits: ['dismissModal'],
  setup(props, { emit }) {
    /* Component properties */
    const form = useForm({
      place_id: props.place?.id,
      reservation_date: new Date().toISOString(),
      occasion: null,
      number_of_guests: null,
      additional_requirements: null,
    });

    /* Event handlers */
    const storeOrUpdateReservation = (): void => {
      form.post(route('regular.reservation.store'), {
        preserveState: true,
        only: ['errors', 'flash'],
      });
    };

    /* Composables */
    return {
      /* Component properties */
      form,

      /* Event handlers */
      storeOrUpdateReservation,
    };
  },
});
</script>