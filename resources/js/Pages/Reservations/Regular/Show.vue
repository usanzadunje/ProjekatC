<template>
  <div>
    <div class="pt-10 flex justify-between items-center">
      <h2 class="text-4xl font-medium">
        {{ `Reservation at ${reservation.place.name}` }}
      </h2>
      <div
          class="text-xl font-medium"
          :class="reservation.approved_at ? 'text-green-700' : 'text-red-600'"
      >
        {{ reservation.approved_at ? 'Approved' : 'Not approved' }}
      </div>
    </div>
    <div class="mt-12 flex gap-4 mt-12">
      <div class="w-1/2 flex flex-col items-center">
        <PreviewInput
            label="Occasion"
            icon="fas fa-edit"
            :content="reservation.occasion"
        />
        <PreviewInput
            label="Reservation date"
            icon="fas fa-edit"
            :content="dayjs(reservation.reservation_date).format('DD.MM.YYYY')"
        />
        <PreviewInput
            label="Requested at"
            icon="fas fa-edit"
            :content="dayjs(reservation.created_at).format('DD.MM.YYYY')"
        />
      </div>
      <div class="w-1/2 flex flex-col items-center">
        <PreviewInput
            label="Guest number"
            icon="fas fa-edit"
            :content="reservation.number_of_guests"
        />
        <PreviewInput
            label="Your additional requirements"
            icon="fas fa-edit"
            :content="reservation.additional_requirements"
        />
        <PreviewInput
            label="Address"
            icon="fas fa-edit"
            :content="reservation.place.address"
        />
        <div class="text-2xl">
          <p class="font-medium text-primary-600">Offers: </p>
          <div v-for="offer in reservation.offers" :key="offer.id">
            {{ offer.name }}
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

import Layout       from '@/Shared/Layout.vue';
import PreviewInput from '@/Shared/PreviewInput.vue';

import dayjs from 'dayjs';

import { Reservation } from '@/types';

export default defineComponent({
  name: 'Reservations/Regular/Show',
  components: {
    Layout,
    PreviewInput,
  },
  layout: Layout,
  props: {
    reservation: {
      type: Object as PropType<Reservation>,
      required: false,
    },
  },
  setup() {
    /* Component properties */


    /* Lifecycle hooks */


    /* Event handlers */


    return {
      /* Component properties */

      /* Event handlers */
      /* Helpers */
      dayjs,
    };
  },
});
</script>
