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
      @filter-changed="fetchReservations"
  >
    <div class="p-6  bg-indigo-300">
      <div class="w-full ">
        <table class="table-auto">
          <thead>
          <tr>
            <th>Name:</th>
            <th>Address:</th>
            <th>Reservation Date:</th>
            <th>Approved Date:</th>
            <th>Submition Date:</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="reservation in reservations.data" :key="reservation.id">
            <td class="px-4">{{ `${reservation.place_name}` }}</td>
            <td class="px-4">{{ reservation.place_address }}</td>
            <td class="px-4">{{ reservation.reservation_date }}</td>
            <td class="px-4">{{ reservation.approved_at }}</td>
            <td class="px-4">{{ reservation.created_at }}</td>
            <td class="px-4">
              <Link
                  :href="route('regular.reservation.destroy', reservation.id)"
                  method="delete"
                  as="button"
                  type="button"
                  class="text-red-500 font-bold"
              >
                X
              </Link>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
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
    };
  },
});

</script>
