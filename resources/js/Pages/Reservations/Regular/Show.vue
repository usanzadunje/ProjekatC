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
    <div class="mt-12">
      <div>
        Occasion: {{ reservation.occasion }}
      </div>
      <div>
        Reservation date: {{ dayjs(reservation.reservation_date).format('DD.MM.YYYY') }}
      </div>
      <div>
        Guest number: {{ reservation.number_of_guests }}
      </div>
      <div>
        Requested at: {{ dayjs(reservation.created_at).format('DD.MM.YYYY') }}
      </div>
      <div>
        Your requirements: {{ reservation.additional_requirements }}
      </div>
      <div>
        Address: {{ reservation.place.address }}
      </div>
      <div>
        Offers: {{ reservation.offers }}
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

import Layout from '@/Shared/Layout.vue';

import dayjs from 'dayjs';

import { Reservation } from '@/types';


export default defineComponent({
  name: 'Reservations/Regular/Show',
  components: {
    Layout,
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
