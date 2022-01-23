<template>
  <div>
    <AppHead title="Users"/>
    <h1 class="text-3xl text-red-500">Reservations Index</h1>

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
    <AppPagination
        :pagination="{prev_page_url: reservations.prev_page_url, next_page_url: reservations.next_page_url, first_page_url: route('regular.reservation.index')}"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link }            from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AppHead       from '@/Shared/AppHead.vue';
import Layout        from '@/Shared/Layout.vue';
import AppPagination from '@/Shared/AppPagination.vue';

export default defineComponent({
  name: 'Reservations/Regular/Index',
  components: {
    AppHead,
    Link,
    AppPagination,
  },
  layout: Layout,
  props: {
    reservations: {
      type: Object,
    },
  },
  setup() {
    return {
      route,
    };
  },
});
</script>