// require('./bootstrap');
// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';


//Plugins
import VueSweetalert2 from "vue-sweetalert2";
import 'sweetalert2/dist/sweetalert2.min.css';
// import 'summernote/dist/summernote.css';
// import VueSummernote from 'vue-summernote'



const el = document.getElementById('app');

createInertiaApp({
    resolve: (name) => require(`./Pages/${name}`),
    setup({ el, app, props, plugin }) {
        createApp({ render: () => h(app, props) })
            .mixin({ methods: { route } })
            .use(plugin)
            .use(VueSweetalert2)
            // .use(VueSummernote)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
