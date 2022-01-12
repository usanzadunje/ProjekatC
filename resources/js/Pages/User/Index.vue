<template>
  <div>
    <AppHead title="Users"/>
    <h1 class="text-3xl text-red-500">Users Index</h1>

    <div>
      {{ users }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import AppHead                       from '@/Shared/AppHead.vue';
import Layout                        from '@/Shared/Layout.vue';

import { User } from '@/types';

export default defineComponent({
  name: 'User/Index',
  components: {
    AppHead,
  },
  layout: Layout,
  props: {
    users: {
      type: Object as PropType<User[]>,
    },
  },
  setup() {
    return {};
  },
});
</script>