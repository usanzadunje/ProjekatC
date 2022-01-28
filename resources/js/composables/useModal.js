import { ref } from "vue";
export default function useModal() {
    const isOpen = ref(false);
    const modalData = ref(null);
    const openModal = (state, data = null) => {
        modalData.value = data;
        isOpen.value = state;
    };
    return {
        isOpen,
        modalData,
        openModal,
    };
}
