<template>
  <div>
    <AppHead title="Add new client"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <table class="table-auto">
          <thead>
          <tr>
            <th>Email</th>
            <th>Place:</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="client in clients" :key="client.id">
            <td class="px-4">{{ client.email }}</td>
            <td class="px-4">{{ client.place.name }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link, useForm }             from '@inertiajs/inertia-vue3';
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

    const form = useForm({
      user: {
        email: null,
        password: null,
      },
      place: {
        name: null,
        city: null,
        address: null,
      },
    });

    const login = () => {
      form.post(
          route('admin.client.store'),
      );
    };


    return {
      form,
      login,
      route,
    };
  },
});
</script>