<template>
  <DefaultContainer
      title="Your reservations"
      heading="Reservations"
      :paginator="
      {
        pagination: {
          prev_page_url: reservations.prev_page_url,
          next_page_url: reservations.next_page_url,
          first_page_url: route('regular.reservation.index')
        },
        queries: filterQuery
      }"
      class="px-8 pb-8"
      @filter-changed="fetchReservations"
  >
    <div class="flex flex-col gap-4 mt-6">
      <div
          v-for="reservation in reservations.data" :key="reservation.id"
          class="px-12 pt-3 pb-6 bg-white rounded-xl h-28 cursor-pointer hover:scale-105"
      >
        <div class="flex justify-between h-full">
          <div class="flex flex-col items-center gap-4 w-1/12">
            <span class="font-medium text-primary-600">Place</span>
            <span class="font-light break-all text-center">
              {{ reservation.place_name }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/6">
            <span class="font-medium text-primary-600">Address</span>
            <span class="font-light break-all text-center">
              {{ reservation.place_address }}
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
              {{ reservation.approved_at ? 'approved' : 'not approved' }}
            </span>
          </div>
          <div class="flex flex-col items-center gap-4 w-1/12">
            <span class="font-medium text-primary-600">Actions</span>
            X
          </div>
        </div>
      </div>
    </div>
    <!--            <th>Name:</th>-->
    <!--            <th>Address:</th>-->
    <!--            <th>Reservation Date:</th>-->
    <!--            <th>Approved Date:</th>-->
    <!--            <th>Submition Date:</th>-->
    <!--      <Link-->
    <!--          :href="route('regular.reservation.destroy', reservation.id)"-->
    <!--          method="delete"-->
    <!--          as="button"-->
    <!--          type="button"-->
    <!--          class="text-red-500 font-bold"-->
    <!--      >-->
    <!--        X-->
    <!--      </Link>-->
  </DefaultContainer>
</template>

<script lang="ts">
import { defineComponent, ref }    from 'vue';
import { Inertia, RequestPayload } from '@inertiajs/inertia';
import { Link }                    from '@inertiajs/inertia-vue3';
import route                       from 'ziggy';
import * as dayjs                  from 'dayjs';

import Layout           from '@/Shared/Layout.vue';
import DefaultContainer from '@/Shared/DefaultContainer.vue';

export default defineComponent({
  name: 'Reservations/Regular/Index',
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
          route('regular.reservation.index'),
          filterQuery.value,
          {
            only: ['reservations'],
            replace: true,
            preserveState: true,
          },
      );
    };

    return {
      /* Component properties */
      filterQuery,

      /* Event handlers */
      fetchReservations,

      /* Helpers */
      route,
      dayjs,
    };
  },
});

</script>
