<template>
  <div class="relative">
    <div
        class="flex gap-2 cursor-pointer items-center"
        @click="hideDropdown"
    >
      <AppAvatar
          :avatar="auth.user.avatar"
          class="hidden xs:block"
      />
      <AppDisplayName class="font-normal"/>
      <i class="fas fa-chevron-down text-gray-400 ml-1"></i>
    </div>
    <div
        ref="dropdown"
        v-show="showDropdown"
        class="cursor-pointer absolute top-11 right-0 z-10 w-44 text-base list-none bg-white rounded-b-xl divide-y divide-gray-100 shadow"
        @click="showDropdown = false"
    >
      <ul>
        <li
            v-for="menuLink in menu"
            :key="menuLink.name"
            class="text-gray-700 hover:bg-gray-100 py-2 px-6"
        >
          <Link :href="route(menuLink.route)" as="button" type="button">
            {{ menuLink.name }}
          </Link>
        </li>
      </ul>
      <div class="text-gray-500 hover:bg-gray-100 rounded-b-xl">
        <Link :href="route('logout')" method="post" as="button" type="button" class="py-2 px-6">
          Logout
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { Link }                 from '@inertiajs/inertia-vue3';
import route                    from 'ziggy';

import AppAvatar      from '@/Shared/AppAvatar.vue';
import AppDisplayName from '@/Shared/AppDisplayName.vue';

import { useAuth } from '@/composables/useAuth';

import { MenuLink } from '@/types';

export default defineComponent({
  name: 'ProfileDropdown',
  components: {
    AppAvatar,
    AppDisplayName,
    Link,
  },
  props: {},
  setup() {
    /* Component properties */
    const showDropdown = ref<Boolean>(false);
    const dropdown = ref();
    const { auth } = useAuth();

    const adminDropdownMenu: MenuLink[] = [
      {
        name: 'Dashboard',
        route: 'regular.dashboard',
      },
      {
        name: 'Clients',
        route: 'admin.client.index',
      },
      {
        name: 'Settings',
        route: 'admin.dashboard',
      },
    ];
    const staffDropdownMenu: MenuLink[] = [
      {
        name: 'Dashboard',
        route: 'staff.dashboard',
      },
      {
        name: 'Reservations',
        route: 'staff.reservation.index',
      },
      {
        name: 'Settings',
        route: 'staff.dashboard',
      },
    ];
    const regularDropdownMenu: MenuLink[] = [
      {
        name: 'Dashboard',
        route: 'regular.dashboard',
      },
      {
        name: 'Reservations',
        route: 'regular.reservation.index',
      },
      {
        name: 'Settings',
        route: 'regular.dashboard',
      },
    ];
    const getUserDropdownMenu = (): MenuLink[] => {
      if(auth.hasRole('admin')) {
        return adminDropdownMenu;
      }

      if(auth.hasRole('staff')) {
        return staffDropdownMenu;
      }

      if(auth.hasRole('regular')) {
        return regularDropdownMenu;
      }

      return [];
    };
    const menu: MenuLink[] = getUserDropdownMenu();

    /* Event handlers */
    // Making sure to close dropdown no matter where user clicks on page
    document.addEventListener('click', () => {
      if(showDropdown.value) {
        showDropdown.value = false;
      }
    });
    const hideDropdown = (e: Event) => {
      // Stopping propagation so document event doesn't cancel this event
      // in event propagation cascading
      e.stopPropagation();

      showDropdown.value = !showDropdown.value;
    };

    return {
      /* Component properties */
      showDropdown,
      dropdown,
      menu,
      auth,

      /* Event handlers */
      hideDropdown,

      /* Helpers */
      route,
    };
  },
});
</script>