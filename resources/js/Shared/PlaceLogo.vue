<template>
  <div>
    <img
        :src="placeLogoPath(placeId)"
        alt="Place logo image"
        class="h-14 w-14 rounded-full object-cover object-center"
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
    placeId: {
      type: Object as PropType<number>,
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