import { watch } from 'vue';
export default function useCustomWatchers() {
    let debounceTimeout;
    let throttleTimeout;
    const debounceWatch = (source, callback, wait) => {
        watch(source, () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                callback();
            }, wait);
        });
    };
    const throttleWatch = (source, callback, every) => {
        watch(source, () => {
            if (throttleTimeout) {
                return;
            }
            throttleTimeout = setTimeout(() => {
                callback();
                throttleTimeout = undefined;
            }, every);
        });
    };
    return {
        debounceWatch,
        throttleWatch,
    };
}
