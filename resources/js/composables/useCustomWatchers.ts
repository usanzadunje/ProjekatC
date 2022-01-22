/**
 * Composable which provides wrapper functions for Vue watch API
 * with changes added to it.
 */
import { watch } from 'vue';

export function useCustomWatchers() {
    let debounceTimeout: number;
    let throttleTimeout: number | undefined;

    /**
     * Executes callback function only once in provided wait time
     * but only when source stops changing, every change of source
     * forces callback to be delayed for new wait time.
     */
    const debounceWatch = (source: object, callback: Function, wait: number) => {
        watch(source, () => {
            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                callback();
            }, wait);
        });
    };

    /**
     * Executes callback every time provided('every') time passes regardless of
     * how many times source changes callback will be called exactly once
     * on each timespan.
     */
    const throttleWatch = (source: object, callback: Function, every: number) => {
        watch(source, () => {
            if(throttleTimeout) {
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
