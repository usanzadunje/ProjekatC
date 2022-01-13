<template>
  <div>
    <AppHead title="Add new client"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <form @submit.prevent="login">
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" v-model="form.user.email"><br>
          <label for="password">Password:</label><br>
          <input type="text" id="password" name="password" v-model="form.user.password"><br>
          <hr>
          <label for="name">Company name:</label><br>
          <input type="text" id="name" name="name" v-model="form.place.name"><br>
          <label for="city">City:</label><br>
          <input type="text" id="city" name="city" v-model="form.place.city"><br>
          <label for="address">Address:</label><br>
          <input type="text" id="address" name="address" v-model="form.place.address"><br>
          <input type="submit" value="Add" class="mt-2 border border-black cursor-pointer">
        </form>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link, useForm }   from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Clients/Create',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
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