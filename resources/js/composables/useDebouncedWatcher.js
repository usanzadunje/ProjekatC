import { ref, watch } from 'vue';
export function useDebouncedWatcher() {
    let timeout = ref();
    const debouncedWatch = (source, callback, wait) => {
        watch(source, () => {
            clearTimeout(timeout.value);
            timeout.value = setTimeout(() => {
                callback();
            }, wait);
        });
    };
    return {
        debouncedWatch,
    };
}
