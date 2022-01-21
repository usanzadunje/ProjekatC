<template>
  <div
      class="bg-white rounded-xl h-60 w-full word-wrap"
  >
    <PlaceLogo
      :place-name="place.name"
    />

    {{ place.name }}
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

import PlaceLogo from '@/Shared/PlaceLogo.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'PlaceCard',
  components: {
    PlaceLogo,
  },
  props: {
    place: {
      type: Object as PropType<Place>,
      required: true,
    },
  },
  setup() {


    return {
    };
  },
});
</script>