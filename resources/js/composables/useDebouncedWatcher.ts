import { ref, watch } from 'vue';


export function useDebouncedWatcher() {
    let timeout = ref<number | undefined>();

    const debouncedWatch = (source: object, callback: Function, wait: number) => {
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