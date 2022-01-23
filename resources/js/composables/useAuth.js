import { computed, reactive } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { Role } from '@/types';
export function useAuth() {
    const authProp = computed(() => usePage().props.value.auth);
    const hasRole = (role) => {
        if (typeof role === 'string') {
            const enumKey = role.toUpperCase();
            role = Role[enumKey];
        }
        return role === auth?.user?.role_id;
    };
    const hasAnyRole = (roles) => {
        for (let i = 0; i < roles.length; i++) {
            let role = roles[i];
            if (typeof role === 'string') {
                const enumKey = role.toUpperCase();
                role = Role[enumKey];
            }
            if (auth?.user?.role_id !== role) {
                continue;
            }
            return true;
        }
        return false;
    };
    const auth = reactive({
        user: authProp.value.user,
        hasRole,
        hasAnyRole,
    });
    return {
        auth,
    };
}
