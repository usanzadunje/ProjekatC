import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp }  from '@inertiajs/inertia-vue3';
import { InertiaProgress }   from '@inertiajs/progress';
import axios                 from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

InertiaProgress.init();

const pages: any = import.meta.glob('./Pages/**/*.vue');

createInertiaApp({
    resolve: (name: string) => {
        const importPage: any = pages[`./Pages/${name}.vue`];

        if(!importPage) {
            throw new Error(`Unknown page ${name}. Is it located under Pages with a .vue extension?`);
        }

        return importPage().then((module: any) => module.default);
    },
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .use(plugin)
            .mount(el);
    },
});
