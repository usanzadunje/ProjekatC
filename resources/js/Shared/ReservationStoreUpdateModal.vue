<template>
  <div class="w-96 h-78 bg-primary-paint-300 rounded-xl p-8">
    <h2 class="text-xl text-medium text-center">
      {{ place ? `Edit reservation for: ${place.name}` : `Create new reservation for: ${place.name}` }}place
    </h2>
    <form @submit.prevent="storeOrUpdateReservation">
      <AppInput
          :required="true"
          label="Project name"
          type="text"
          :autofocus="true"
          v-model="form.name"
          :errors="form.errors.name"
          placeholder="Project name..."
          class="mt-8"
          @focus="form.clearErrors('name')"
      />
      <AppLoadingButton
          :loading="form.processing"
          class="bg-primary-600 hover:bg-primary-900 w-full rounded-full mt-12 py-3 px-6 text-white font-medium"
      >
        {{ place ? 'Update' : 'Create' }}
      </AppLoadingButton>
    </form>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { useForm }                   from '@inertiajs/inertia-vue3';

import AppInput         from '@/Shared/AppInput.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'ReservationStoreUpdateModal',
  props: {
    place: {
      type: Object as PropType<Place>,
      required: false,
    },
  },
  components: {
    AppInput,
    AppLoadingButton,
  },
  emits: ['dismissModal'],
  setup() {
    /* Component properties */
    const form = useForm({
      name: null,
    });

    /* Event handlers */
    const storeOrUpdateReservation = (): void => {
      console.log('sadasd');
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