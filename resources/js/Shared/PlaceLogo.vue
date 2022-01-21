<template>
  <div class="h-9 w-9 rounded-full">
    <img
        :src="placeLogoPath(placeName)"
        alt="Place logo image"
        class="rounded-full object-cover object-center"
    >
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

import { placeLogoPath } from '@/utils/path';

export default defineComponent({
  name: 'PlaceLogo',
  components: {},
  props: {
    placeName: {
      type: Object as PropType<string>,
      required: true,
    },
  },
  setup() {
    return {
      placeLogoPath,
    };
  },
});
</script>