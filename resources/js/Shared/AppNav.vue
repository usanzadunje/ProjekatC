<template>
  <div class="w-full h-14 px-4 flex justify-between items-center bg-white">
    <div class="flex gap-12">
      <div>
        <h1 class="font-medium text-2xl">
          ProjekatC
        </h1>
      </div>
      <div>
        <AppSearchBox/>
      </div>
      <div>Links</div>
    </div>
    <ProfileDropdown/>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AppSearchBox    from '@/Shared/AppSearchBox.vue';
import ProfileDropdown from '@/Shared/ProfileDropdown.vue';

export default defineComponent({
  name: 'AppNav',
  components: {
    AppSearchBox,
    ProfileDropdown,
  },
  props: {},
  setup() {


    return {};
  },
});
</script>