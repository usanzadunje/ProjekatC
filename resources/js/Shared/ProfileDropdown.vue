<template>
  <div class="relative">
    <div
        class="flex gap-2 cursor-pointer items-center"
        @click="hideDropdown"
    >
      <AppAvatar/>
      <AppDisplayName/>
      <div>
        <i class="fas fa-chevron-down text-gray-300"></i>
      </div>
    </div>
    <div
        ref="dropdown"
        v-show="showDropdown"
        class="cursor-pointer absolute top-11 right-0 z-10 w-44 text-base list-none bg-white rounded-b-xl divide-y divide-gray-100 shadow"
        @click="showDropdown = false"
    >
      <ul>
        <li class="text-gray-700 hover:bg-gray-100 py-2 px-6">
          <Link :href="route('regular.reservation.index')" as="button" type="button">
            Reservations
          </Link>
        </li>
        <li class="text-gray-700 hover:bg-gray-100 py-2 px-6">
          <!--          <Link :href="route('settings')" as="button" type="button">-->
          Settings
          <!--          </Link>-->
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
      hideDropdown,
      /* Component properties */
      showDropdown,
      dropdown,

      /* Helpers */
      route,
    };
  },
});
</script>