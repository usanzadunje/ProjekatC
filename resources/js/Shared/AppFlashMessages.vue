<template>
  <teleport to="body">
    <div
        v-if="$page.props.flash.success"
        class="absolute right-8 bottom-8 w-40 h-12 bg-green-500 rounded-md"
    >
      {{ $page.props.flash.success }}
    </div>
    <div
        v-if="$page.props.flash.error"
        class="absolute right-8 bottom-8 w-40 h-12 bg-red-500 rounded-md"
    >
      {{ $page.props.flash.error }}
    </div>
  </teleport>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppFlashMessages',
  components: {},
  props: {
    heading: {
      type: String,
    },
  },
  setup() {

    return {};
  },
});
</script>