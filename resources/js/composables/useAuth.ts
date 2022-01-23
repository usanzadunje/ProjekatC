/**
 * Composable which provides API for working with users
 */
import { computed, reactive } from 'vue';
import { usePage }            from '@inertiajs/inertia-vue3';

import { User, Role } from '@/types';

export function useAuth() {
    const authProp = computed(() => usePage().props.value.auth);

    /**
     * Checks whether user has role provided as string or number value.
     */
    const hasRole = (role: string | number) => {
        if(typeof role === 'string') {
            const enumKey = role.toUpperCase();

            // Getting numeric value from enum from its key
            role = Role[enumKey as keyof typeof Role];
        }

        return role === auth?.user?.role_id;
    };
    /**
     * Checks whether user has any of the roles provided as array of strings or numbers.
     */
    const hasAnyRole = (roles: string[] | number[]) => {
        for(let i = 0; i < roles.length; i++) {
            let role = roles[i];

            if(typeof role === 'string') {
                const enumKey = role.toUpperCase();

                role = Role[enumKey as keyof typeof Role];
            }

            if(auth?.user?.role_id !== role) {
                continue;
            }

            return true;
        }

        return false;
    };

    /**
     * Reactive prop which represents current user logged-in or not.
     */
    const auth = reactive({
        // @ts-ignore
        user: authProp.value.user as User,
        hasRole,
        hasAnyRole,
    });

    return {
        auth,
    };
}
