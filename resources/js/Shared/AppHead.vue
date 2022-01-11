<template>
  <Head :title="title ? `${title} - ProjekatC` : 'ProjekatC'">
    <slot/>
  </Head>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Head }            from '@inertiajs/inertia-vue3';

export default defineComponent({
  name: 'AppHead',
  components: {
    Head,
  },
  props: {
    title: {
      type: String,
    },
  },
  setup() {


    return {};
  },
});
</script>