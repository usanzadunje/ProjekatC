import { watch } from 'vue';

export function useCustomWatchers() {
    let debounceTimeout: number;
    let throttleTimeout: number | undefined;

    const debounceWatch = (source: object, callback: Function, wait: number) => {
        watch(source, () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                callback();
            }, wait);
        });
    };

    const throttleWatch = (source: object, callback: Function, every: number) => {
        watch(source, () => {
            if(throttleTimeout){
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
