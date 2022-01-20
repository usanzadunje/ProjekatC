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
            v-for="menuLink in menu"
            :key="menuLink.name"
            class="flex items-center rounded-md py-2 px-3.5"
            :class="isRoute(menuLink.matchedRoutes) ? 'bg-primary-100 text-black' : 'text-gray-500 hover:text-primary-600'"
        >
          <i
              class="text-xl mr-2"
              :class="[isRoute(menuLink.matchedRoutes) ? 'text-primary-600' : '', menuLink.icon]"
          ></i>
          <Link :href="route(menuLink.route)" as="button" type="button" class="font-medium">
            {{ menuLink.name }}
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

import { MenuLink } from '@/types';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppSearchBox,
    ProfileDropdown,
    Link,
  },
  props: {},
  setup() {
    /* Component properties */
    const currentRouteName = computed<string>(() => usePage().props.value.route as string);
    const menu: MenuLink[] = [
      {
        name: 'Places',
        route: 'regular.dashboard',
        matchedRoutes: 'regular.dashboard',
        icon: 'fas fa-map-marked-alt',
      },
      {
        name: 'Reservations',
        route: 'regular.reservation.index',
        matchedRoutes: 'regular.reservation.index',
        icon: 'fab fa-rust',
      },
    ];

    /* Helpers */
    const isRoute = (...routes: string[]): Boolean => {
      return routes.includes(currentRouteName.value);
    };


    return {
      /* Component properties */
      menu,

      /* Helpers */
      route,
      isRoute,
    };
  },
});
</script>