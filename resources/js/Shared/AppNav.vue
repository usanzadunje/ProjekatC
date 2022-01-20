<template>
  <div class="w-full h-14 px-4 flex justify-between items-center bg-white">
    <div class="flex items-center">
      <div class="mr-6">
        <Link
            :href="route('home')"
            as="button" type="button"
            class="font-medium text-2xl hover:text-gray-500"
        >
          ProjekatC
        </Link>
      </div>
      <div class="mr-24">
        <AppSearchBox/>
      </div>
      <div class="flex items-center gap-4">
        <div
            class="flex items-center rounded-md py-2 px-3.5"
            :class="isURL('regular.dashboard') ? 'bg-primary-100 text-black' : 'text-gray-500 hover:text-primary-600'"
        >
          <i
              class="fas fa-map-marked-alt text-xl mr-2"
              :class="isURL('regular.dashboard') ? 'text-primary-600' : ''"
          ></i>
          <Link :href="route('regular.dashboard')" as="button" type="button" class="font-medium">
            Places
          </Link>
        </div>
        <div
            class="flex items-center rounded-md py-2 px-3.5"
            :class="isURL('regular.reservation.index') ? 'bg-primary-100 text-black' : 'text-gray-500 hover:text-primary-600'"
        >
          <i
              class="fab fa-rust text-xl mr-2"
              :class="isURL('regular.reservation.index') ? 'text-primary-600' : ''"
          ></i>
          <Link :href="route('regular.reservation.index')" as="button" type="button" class="font-medium">
            Reservations
          </Link>
        </div>
      </div>
    </div>
    <ProfileDropdown/>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { Link, usePage }             from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppSearchBox    from '@/Shared/AppSearchBox.vue';
import ProfileDropdown from '@/Shared/ProfileDropdown.vue';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppSearchBox,
    ProfileDropdown,
    Link,
  },
  props: {},
  setup() {
    const currentRouteName = computed<string>(() => usePage().props.value.route as string);

    const isURL = (...urls: string[]): Boolean => {
      return urls.includes(currentRouteName.value);
    };


    return {
      /* Helpers */
      route,
      isURL,
    };
  },
});
</script>