<template>
  <div class="w-full py-5 px-6 flex justify-between items-center bg-white">
    <div class="flex items-center">
      <div class="mr-6">
        <Link
            :href="getHomeLink()"
            as="button" type="button"
            class="font-medium text-2xl hover:text-primary-100"
        >
          ProjekatC
        </Link>
      </div>
      <AppSearchBox
          :global="true"
          class="hidden md:flex mr-16"
          css-classes="py-3 w-46 bg-primary-paint-300"
      />
      <div class="hidden lg:flex  items-center gap-4">
        <div
            v-for="menuLink in menu"
            :key="menuLink.name"
            class="flex items-center rounded-md py-2 px-3.5 cursor-pointer"
            :class="isURL(menuLink.matchedURLs) ? 'bg-primary-100 text-black' : 'text-gray-500 hover:text-primary-600'"
            @click="Inertia.get(route(menuLink.route))"
        >
          <i
              class="text-xl mr-2"
              :class="[isURL(menuLink.matchedURLs) ? 'text-primary-600' : '', menuLink.icon]"
          ></i>
          <span class="font-medium">
            {{ menuLink.name }}
          </span>
        </div>
      </div>
    </div>
    <ProfileDropdown v-if="auth.user"/>
    <div v-else>
      <Link
          :href="route('login')"
          as="button" type="button"
          class="font-medium text-lg hover:text-primary-600"
      >
        Login
      </Link>
      /
      <Link
          :href="route('register')"
          as="button" type="button"
          class="font-medium text-lg hover:text-primary-600"
      >
        Register
      </Link>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, computed } from 'vue';
import { Inertia }                   from '@inertiajs/inertia';
import { Link, usePage }             from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppSearchBox    from '@/Shared/AppSearchBox.vue';
import ProfileDropdown from '@/Shared/ProfileDropdown.vue';

import useAuth from '@/composables/useAuth';

import { MenuLink, Role } from '@/types';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppSearchBox,
    Link,
    ProfileDropdown,
  },
  props: {},
  setup() {
    /* Component properties */
    const currentURL = computed<string>(() => usePage().url.value as string);
    const { auth } = useAuth();

    const guestMenu: MenuLink[] = [
      {
        name: 'Places',
        route: 'regular.place.index',
        matchedURLs: ['place'],
        icon: 'fas fa-map-marked-alt',
      },
    ];
    const adminMenu: MenuLink[] = [
      {
        name: 'Clients',
        route: 'admin.client.index',
        matchedURLs: ['admin/client'],
        icon: 'fas fa-users',
      },
      {
        name: 'Dashboard',
        route: 'admin.dashboard',
        matchedURLs: ['admin/dashboard'],
        icon: 'fas fa-th-large',
      },
    ];
    const staffMenu: MenuLink[] = [
      {
        name: 'Reservations',
        route: 'staff.reservation.index',
        matchedURLs: ['staff/reservation'],
        icon: 'fab fa-rust',
      },
      {
        name: 'Dashboard',
        route: 'staff.dashboard',
        matchedURLs: ['staff/dashboard'],
        icon: 'fas fa-th-large',
      },
    ];
    const regularMenu: MenuLink[] = [
      {
        name: 'Places',
        route: 'regular.place.index',
        matchedURLs: ['place'],
        icon: 'fas fa-map-marked-alt',
      },
      {
        name: 'Reservations',
        route: 'regular.reservation.index',
        matchedURLs: ['reservation'],
        icon: 'fab fa-rust',
      },
      {
        name: 'Dashboard',
        route: 'regular.dashboard',
        matchedURLs: ['dashboard'],
        icon: 'fas fa-th-large',
      },
    ];
    const getUserMenu = (): MenuLink[] => {
      if(auth.hasRole('admin')) {
        return adminMenu;
      }

      if(auth.hasRole('staff')) {
        return staffMenu;
      }

      if(auth.hasRole('regular')) {
        return regularMenu;
      }

      return guestMenu;
    };
    const getHomeLink = (): string => {
      if(auth.hasRole('admin')) {
        return route('admin.dashboard');
      }

      if(auth.hasRole('staff')) {
        return route('staff.dashboard');
      }

      if(auth.hasRole('regular')) {
        return route('regular.place.index');
      }

      return route('regular.place.index');
    };

    // Main menu which is displayed
    const menu: MenuLink[] = getUserMenu();

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
      Inertia,
      auth,

      /* Helpers */
      route,
      isURL,
      Role,
      getHomeLink,
    };
  },
});
</script>