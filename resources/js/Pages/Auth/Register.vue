<template>
  <AuthLayout heading="Sign up">
    <template v-slot:left>
      <form @submit.prevent="register">
        <AppInput
            :required="true"
            label="Email"
            type="text"
            v-model="form.email"
            :error="form.errors.email"
            placeholder="mail@website.com"
            @focus="form.clearErrors('email')"
        />
        <AppInput
            :required="true"
            label="Password"
            type="password"
            v-model="form.password"
            :error="form.errors.password"
            placeholder="Min. 8 characters"
            class="mt-4"
            @focus="form.clearErrors('password')"
        />
        <AppInput
            :required="true"
            label="Confirm Password"
            type="password"
            v-model="form.password_confirmation"
            :error="form.errors.password"
            placeholder="Confirm password"
            class="mt-4"
            @focus="form.clearErrors('password')"
        />
        <div>
          <div class="flex items-center mt-4">
            <input
                type="checkbox"
                class="bg-primary-600"
                v-model="form.tos"
                @focus="form.clearErrors('tos')"
            >
            <p class="ml-2 font-medium">I agree to
              <span class="text-primary-600 font-semibold">Terms & Conditions</span>
            </p>
          </div>
          <div v-if="form.errors.tos" class="mt-1 text-red-500">{{ form.errors.tos }}</div>
        </div>
        <AppLoadingButton
            :loading="form.processing"
            class="bg-primary-600 w-full rounded-full mt-6 py-3 px-6 text-white font-medium"
        >
          Sign up
        </AppLoadingButton>
        <div class="mt-8 font-medium">
          <p>
            Already have an account?
            <Link :href="route('login')" as="button" type="button" class="text-primary-600 font-semibold" replace>
              Sign in
            </Link>
          </p>
        </div>
      </form>
    </template>
    <template v-slot:right>
      <div class="w-full h-full register-image rounded-r-xl">
      </div>
    </template>
  </AuthLayout>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link, useForm }   from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AuthLayout       from '@/Shared/AuthLayout.vue';
import AppInput         from '@/Shared/AppInput.vue';
import AppLoadingButton from '@/Shared/AppLoadingButton.vue';

export default defineComponent({
  name: 'Register',
  components: {
    AuthLayout,
    Link,
    AppInput,
    AppLoadingButton,
  },
  setup() {
    /* Component properties */
    const form = useForm({
      email: null,
      password: null,
      password_confirmation: null,
      tos: false,
    });

    /* Event handlers */
    const register = () => {
      form.post(
          route('register'),
          {
            replace: true,
          },
      );
    };

    return {
      /* Component properties */
      form,

      /* Event handlers */
      register,

      /* Helpers */
      route,
    };
  },
});
</script>
<style>
.register-image {
  background-color: #3521B5;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 200 200'%3E%3Cdefs%3E%3ClinearGradient id='a' gradientUnits='userSpaceOnUse' x1='100' y1='33' x2='100' y2='-3'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3ClinearGradient id='b' gradientUnits='userSpaceOnUse' x1='100' y1='135' x2='100' y2='97'%3E%3Cstop offset='0' stop-color='%23000' stop-opacity='0'/%3E%3Cstop offset='1' stop-color='%23000' stop-opacity='1'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='%232316aa' fill-opacity='0.6'%3E%3Crect x='100' width='100' height='100'/%3E%3Crect y='100' width='100' height='100'/%3E%3C/g%3E%3Cg fill-opacity='0.5'%3E%3Cpolygon fill='url(%23a)' points='100 30 0 0 200 0'/%3E%3Cpolygon fill='url(%23b)' points='100 100 0 130 0 100 200 100 200 130'/%3E%3C/g%3E%3C/svg%3E");
}
</style>