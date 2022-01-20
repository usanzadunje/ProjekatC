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
            :class="isURL(menuLink.matchedURLs) ? 'bg-primary-100 text-black' : 'text-gray-500 hover:text-primary-600'"
        >
          <i
              class="text-xl mr-2"
              :class="[isURL(menuLink.matchedURLs) ? 'text-primary-600' : '', menuLink.icon]"
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
    const currentURL = computed<string>(() => usePage().url.value as string);
    const menu: MenuLink[] = [
      {
        name: 'Places',
        route: 'regular.dashboard',
        matchedURLs: ['root', 'reservation'],
        icon: 'fas fa-map-marked-alt',
      },
      {
        name: 'Reservations',
        route: 'regular.reservation.index',
        matchedURLs: ['reservation'],
        icon: 'fab fa-rust',
      },
    ];

    /* Helpers */
    const isURL = (urls: string[]): Boolean => {
      const current: string = currentURL.value.substring(1);
      /**
       * Since root route URL which is '/' (empty string, when substring) will match every single URL in filter string function
       * we gave it an alias of 'root' which will match route '/' but no other route
       * 'root' alias should be unique and should not be present in any other route URL, or it will cause false positives
       */
      if(urls[0] === 'root' && current === '') {
        return true;
      }

      return !!urls.filter(url => current.startsWith(url)).length;
    };


    return {
      /* Component properties */
      menu,

      /* Helpers */
      route,
      isURL,
    };
  },
});
</script>