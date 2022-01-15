<template>
  <div>
    <AppHead title="Add new client"/>
    <div class="p-6 bg-indigo-300">
      <div class="w-full">
        <table class="table-auto">
          <thead>
          <tr>
            <th>Email</th>
            <th>Place:</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="client in clients" :key="client.id">
            <td class="px-4">{{ client.email }}</td>
            <td class="px-4">{{ client.place.name }}</td>
            <td class="px-4">
              <Link
                  :href="route('admin.client.destroy', client.id)"
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

import AppHead  from '@/Shared/AppHead.vue';
import Layout   from '@/Shared/Layout.vue';
import { User } from '@/types';

export default defineComponent({
  name: 'Clients/Index',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  props: {
    clients: {
      type: Object as PropType<User[]>,
    },
  },
  setup() {

    return {
      route,
    };
  },
});
</script>