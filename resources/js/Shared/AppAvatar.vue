<template>
  <div class="h-9 w-9 rounded-full">
    <img
        :src="avatarPath($page.props.auth?.user?.avatar ?? 'avatar.png')"
        alt="User avatar"
        class="rounded-full object-cover object-center"
    >
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { avatarPath }      from '@/utils/path';

export default defineComponent({
  name: 'AppAvatar',
  components: {},
  props: {},
  setup() {
    return {
      avatarPath,
    };
  },
});
</script>