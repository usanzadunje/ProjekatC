<template>
  <div
      v-show="pagination.prev_page_url || pagination.next_page_url"
      class="relative flex justify-center mt-10 text-xl"
  >
    <div>
      <Link
          :disabled="!pagination.prev_page_url"
          :href="pagination.prev_page_url"
          as="button" type="button"
          :data="queries"
          preserve-state
          class="px-6 py-1.5 rounded-l-full border-r-2 border-white bg-gray-600 text-white font-light"
          :class="pagination.prev_page_url ? ' hover:bg-gray-400' : ''"
      >
        Prev
      </Link>
      <Link
          :disabled="!pagination.next_page_url"
          :href="pagination.next_page_url"
          as="button" type="button"
          :data="queries"
          preserve-state
          class="px-6 py-1.5 rounded-r-full bg-gray-600 text-white font-light"
          :class="pagination.next_page_url ? ' hover:bg-gray-400' : ''"
      >
        Next
      </Link>
    </div>
    <Link
        :href="pagination.first_page_url"
        as="button" type="button"
        :data="queries"
        preserve-state
        class="absolute left-0 px-6 py-1.5 text-gray-600 hover:text-gray-400 font-semibold underline"
    >
      First page
    </Link>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link }                      from '@inertiajs/inertia-vue3';

import { Paginator } from '@/types';

export default defineComponent({
  name: 'AppPagination',
  components: {
    Link,
  },
  props: {
    pagination: {
      type: Object as PropType<Paginator>,
      required: true,
    },
    queries: {
      type: Object,
    },
  },
  setup() {
    return {};
  },
});
</script>