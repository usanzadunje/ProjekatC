<template>
  <div>
    <AppHead title="Login"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <form @submit.prevent="login">
          <label for="username">Login:</label><br>
          <input type="text" id="username" name="username" v-model="form.username"><br>
          <label for="password">Password:</label><br>
          <input type="text" id="password" name="password" v-model="form.password"><br>
          <input type="submit" value="Login" class="mt-2 border border-black cursor-pointer">
          <Link :href="route('register')" as="button" type="button" class="mt-2 border border-black">Register</Link>
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
  name: 'Login',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  setup() {

    const form = useForm({
      username: null,
      password: null,
    });

    const login = () => {
      form.post(
          route('login'),
          {
            replace: true,
          },
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