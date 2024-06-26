// noinspection JSIgnoredPromiseFromCall
import '../css/app.css'
import './bootstrap';

import { createApp, h, type DefineComponent } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

import PrimeVue from "primevue/config";
import Aura from 'primevue/themes/aura';

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob<DefineComponent>('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue, {
                theme: {
                    preset: Aura
                }
            })
            .mount(el)
    },
});