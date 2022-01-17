<template>
  <AppHead title="Login"/>
  <AuthLayout>
    <template v-slot:left>
      <div class="w-full h-full flex flex-col justify-center ">
        <div>
          <i class="fas fa-bolt text-primary-600 text-5xl"></i>
        </div>
        <div class="mt-10">
          <h1 class="text-3xl font-semibold">Login</h1>
          <p class="mt-2 text-gray-600">Reserve place for your special occasion!</p>
        </div>
        <div class="mt-14">
          Google sing in
        </div>
        <AppSandwichText content="or Sign in with Email" class="py-6 text-gray-300 opacity-85"/>
        <form @submit.prevent="login">
          <div class="">
            <AppInput
                :required="true"
                label="Login"
                type="text"
                v-model="form.username"
                :error="form.errors.username"
                placeholder="Email or username"
            />
            <AppInput
                :required="true"
                label="Password"
                type="password"
                v-model="form.password"
                :error="form.errors.password"
                placeholder="•••••••"
                class="mt-4"
            />
            <div class="flex justify-between items-center mt-4">
              <div class="flex">
                <input type="checkbox" class="bg-primary-600">
                <span class="ml-2 font-medium">Remember me</span>
              </div>
              <Link :href="route('password.update')"
                    as="button" type="button"
                    class="text-primary-600 font-semibold"
              >
                Forgot password?
              </Link>
            </div>
            <AppLoadingButton
                :loading="form.processing"
                class="bg-primary-600 w-full rounded-full mt-6 py-3 px-6 text-white font-medium"
            >
              Login
            </AppLoadingButton>
            <div class="mt-8 font-medium">
              <p>
                Not registered yet?
                <Link :href="route('register')" as="button" type="button" class="text-primary-600 font-medium">
                  Create an Account
                </Link>
              </p>
            </div>
          </div>
        </form>
      </div>
      <div class="w-full font-medium text-gray-400 mb-8">
        <i class="far fa-copyright"></i> 2022 ProjekatC All rights reserved.
      </div>
    </template>
    <template v-slot:right>
      <div class="w-full h-full login-image rounded-r-xl">
      </div>
    </template>
  </AuthLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link, useForm }   from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AuthLayout       from '@/Shared/AuthLayout.vue';
import AppHead          from '@/Shared/AppHead.vue';
import AppSandwichText  from '@/Shared/AppSandwichText.vue';
import AppInput         from '@/Shared/AppInput.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';

export default defineComponent({
  name: 'Login',
  components: {
    AuthLayout,
    AppHead,
    Link,
    AppSandwichText,
    AppInput,
    AppLoadingButton,
  },
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