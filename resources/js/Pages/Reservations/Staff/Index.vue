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
            <th>Email:</th>
            <th>Reservation Date:</th>
            <th>Approved Date:</th>
            <th>Submition Date:</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="reservation in reservations" :key="reservation.id">
            <td class="px-4">{{ `${reservation.reservee.first_name} ${reservation.reservee.last_name}` }}</td>
            <td class="px-4">{{ reservation.reservee.email }}</td>
            <td class="px-4">{{ reservation.reservation_date }}</td>
            <td class="px-4">{{ reservation.approved_at }}</td>
            <td class="px-4">{{ reservation.created_at }}</td>
            <td class="px-4">
              <Link
                  :href="route('staff.reservation.destroy', reservation.id)"
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
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link }                      from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

import { Reservation } from '@/types';

export default defineComponent({
  name: 'Reservations/Staff/Index',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  props: {
    reservations: {
      type: Object as PropType<Reservation[]>,
    },
  },
  setup() {
    return {
      route,
    };
  },
});
</script>