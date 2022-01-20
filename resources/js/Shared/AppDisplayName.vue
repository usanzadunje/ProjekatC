<template>
  <div>
    <span
        v-if="$page.props.auth.user.first_name || $page.props.auth.user.last_name"
    >
      {{ `${$page.props.auth.user.first_name} ${$page.props.auth.user.last_name}` }}
    </span>
    <span
        v-else-if="$page.props.auth.user.username"
    >
      {{ $page.props.auth.user.username }}
    </span>
    <span
        v-else
    >
      Unknown
    </span>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppDisplayName',
  components: {},
  props: {},
  setup() {
    return {};
  },
});
</script>