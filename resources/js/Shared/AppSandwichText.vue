<template>
  <div>
    <p>
      <span>{{ content }}</span>
    </p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AppSandwichText',
  components: {},
  props: {
    content: {
      type: String,
    },
  },
  setup() {


    return {};
  },
});
</script>
<style scoped>
p {
  width: 100%;
  text-align: center;
  border-bottom: 1px solid;
  line-height: 0.1em;
  margin: 10px 0 20px;
}

p span {
  background: #fff;
  padding: 0 10px;
}

</style>