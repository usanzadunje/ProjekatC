<template>
  <div>
    <AppHead title="Register"/>
    <div class=" p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <form @submit.prevent="register">
          <label for="email">Email:</label><br>
          <input type="text" id="email" name="email" v-model="form.email"><br>
          <label for="password">Password:</label><br>
          <input type="text" id="password" name="password" v-model="form.password"><br>
          <label for="password_confirmation">Confirm Password:</label><br>
          <input type="text" id="password_confirmation" name="password_confirmation"
                 v-model="form.password_confirmation"><br>
          <input type="submit" value="Register" class="mt-2 border border-black cursor-pointer">
          <Link :href="route('login')" as="button" type="button" class="mt-2 border border-black">Login</Link>
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
  name: 'Register',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  setup() {
    const form = useForm({
      email: null,
      password: null,
      password_confirmation: null,
    });

    const register = () => {
      form.post(
          route('register'),
          {
            replace: true,
          },
      );
    };

    return {
      form,
      register,
      route,
    };
  },
});
</script>