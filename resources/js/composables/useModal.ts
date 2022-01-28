/**
 * Composable that exposes properties and functions to manipulate AppModal component
 */
import { ref } from "vue";

export default function useModal() {
    /* Component properties */
    const isOpen = ref<boolean>(false);
    const modalData = ref<any>(null);

    /* Event handlers */
    const openModal = (state: boolean, data: any = null): void => {
        modalData.value = data;

        isOpen.value = state;
    };

    return {
        /* Component properties */
        isOpen,
        modalData,

        /* Event handlers */
        openModal,
    };
}