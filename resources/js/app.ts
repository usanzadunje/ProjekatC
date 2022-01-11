import './bootstrap';

import { createApp, h }     from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress }  from '@inertiajs/progress';

InertiaProgress.init();

createInertiaApp({
    resolve: name => require(`./Pages/${name}`),
    setup({el, app, props, plugin}) {
        createApp({render: () => h(app, props)})
            .use(plugin)
            .mount(el);
    },
});
