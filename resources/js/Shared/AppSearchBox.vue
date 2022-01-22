<template>
  <div class="relative bg-gray-100 rounded-xl">
    <div
        class="absolute top-0 left-4 flex items-center h-full text-sm font-medium opacity-50"
    >
      <i class="fas fa-search"></i>
    </div>
    <input
        :ref="global ? 'searchBox' : ''"
        type="search"
        placeholder="Search"
        class="py-3 pl-9 pr-2 w-46 rounded-xl text-sm"
        :class="cssClasses"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        @focus="showShortcut = false"
        @blur="showShortcut = true"
    >
    <span
        v-if="global"
        v-show="showShortcut"
        class="absolute top-0 right-4 flex items-center h-full text-sm font-medium opacity-50"
    >
      CTRL+I
    </span>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';

export default defineComponent({
  name: 'AppSearchBox',
  components: {},
  props: {
    global: {
      type: Boolean,
      default: false,
    },
    modelValue: {
      type: String,
    },
    cssClasses: {
      type: String,
    },
  },
  emits: ['update:modelValue', 'focus', 'blur'],
  setup(props) {
    /* Component properties */
    const searchBox = ref();
    const showShortcut = ref<Boolean>(true);


    if(props.global) {
      let keys: number[] = [];

      window.addEventListener('keyup', function(e) {
        let { keyCode } = e || Event;

        if(keyCode === 17 || keyCode === 73) {
          keys[keyCode] = keyCode;

          setTimeout(() => {
            keys = [];
          }, 500);
        }

        if(keys[17] && keys[73]) {
          searchBox.value.focus();

          keys = [];
        }
      });
    }

    return {
      /* Component properties */
      searchBox,
      showShortcut,
    };
  },
});
</script>