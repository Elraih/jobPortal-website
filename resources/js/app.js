import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy-js';


// import debounce from 'lodash.debounce';
// import Ziggy from './ziggy';
// import { route } from 'ziggy-js';
import Footer from './Components/Footer.vue';



createInertiaApp({
    resolve: async name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        const page = pages[`./Pages/${name}.vue`]

        if (name.startsWith('Admin/')) {
            page.default.layout = page.default.layout || (await import('./Layouts/AdminLayout.vue')).default
        } else if (name.startsWith('Company/')) {
            page.default.layout = page.default.layout || (await import('./Layouts/CompanyLayout.vue')).default
        } else if (name.startsWith('Auth/')) {
            page.default.layout = page.default.layout || (await import('./Layouts/Layout.vue')).default
        } else {
            page.default.layout = page.default.layout || (await import('./Layouts/UserLayout.vue')).default
        }

        return page
    },
    setup({ el, App, props, plugin }) {
       createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Link', Link)
            .component('Footer', Footer)
            .mount(el)
    },
})