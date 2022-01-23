<template>
  <DefaultContainer
      title="Your reservations"
      heading="Reservations"
      :paginator="
      {
        pagination: {
          prev_page_url: reservations.prev_page_url,
          next_page_url: reservations.next_page_url,
          first_page_url: route('staff.reservation.index')
        },
        queries: filterQuery
      }"
      class="px-8 pb-8"
      @filter-changed="fetchReservations"
  >
    <template v-slot:search-end>
      CREATE RESERVATION
    </template>
    <div v-if="reservations.data.length > 0" class="flex flex-col gap-4 mt-6">
      <div
          v-for="reservation in reservations.data" :key="reservation.id"
          class="px-8 pt-3 pb-6 bg-white rounded-xl h-28 cursor-pointer hover:scale-105"
          @click="Inertia.get(route('staff.reservation.edit', reservation.id))"
      >
        <div class="flex justify-between h-full">
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Name</span>
            <span class="font-light break-all text-center">
              {{ `${reservation.user_first_name} ${reservation.user_last_name}` }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Email</span>
            <span class="font-light break-all text-center">
              {{ reservation.user_email }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Reservation Date</span>
            <span class="font-light break-all text-center">
              {{ dayjs(reservation.reservation_date).format('DD.MM.YYYY') }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Requested Date</span>
            <span class="font-light break-all text-center">
              {{ dayjs(reservation.created_at).format('DD.MM.YYYY') }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Status</span>
            <span class="font-light break-all text-center">
              {{
                reservation.approved_at ?
                    dayjs(reservation.approved_at).format('DD.MM.YYYY')
                    : 'pending'
              }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Actions</span>
            <div>
              <Link
                  :href="route('staff.reservation.edit', reservation.id)"
                  as="button"
                  type="button"
                  class="text-white text-2xl bg-green-700 py-1 px-2 rounded-md hover:bg-green-600"
              >
                <i class="fas fa-edit"></i>
              </Link>
              <Link
                  as="button"
                  type="button"
                  class="text-white text-2xl bg-red-600 py-1 px-2 rounded-md ml-2 hover:bg-red-500"
                  @click="destroyReservation($event, reservation.id)"
              >
                <i class="fas fa-trash-alt"></i>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      Nobody has made reservation yet.
    </div>
  </DefaultContainer>
</template>

<script lang="ts">
import { defineComponent, ref }    from 'vue';
import { Inertia, RequestPayload } from '@inertiajs/inertia';
import { Link }                    from '@inertiajs/inertia-vue3';
import route                       from 'ziggy';

import Layout           from '@/Shared/Layout.vue';
import DefaultContainer from '@/Shared/DefaultContainer.vue';

import dayjs from 'dayjs';

export default defineComponent({
  name: 'Reservations/Staff/Index',
  components: {
    Link,
    DefaultContainer,
  },
  layout: Layout,
  props: {
    reservations: {
      type: Object,
    },
  },
  setup() {
    /* Component properties */
    const filterQuery = ref<RequestPayload>();

    /* Event handlers */
    const fetchReservations = (filter: string) => {
      filterQuery.value = filter ? { filter } : {};

      Inertia.get(
          route('staff.reservation.index'),
          filterQuery.value,
          {
            only: ['reservations'],
            replace: true,
            preserveState: true,
          },
      );
    };
    const destroyReservation = (e: Event, reservationId: number) => {
      e.stopPropagation();

      Inertia.delete(
          route('staff.reservation.destroy', reservationId),
          {
            only: ['reservations'],
            replace: true,
          },
      );
    };
    return {
      /* Component properties */
      filterQuery,

      /* Event handlers */
      fetchReservations,
      destroyReservation,

      /* Helpers */
      Inertia,
      route,
      dayjs,
    };
  },
});
</script>