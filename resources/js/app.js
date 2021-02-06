require('./bootstrap');
require('./main')
require('@fortawesome/fontawesome-free')
require('moment');
// import Cropper from 'cropperjs'

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';

import '@/components';

Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);

const Swal = require('sweetalert2')
window.Toast = Swal.mixin({
    toast:true,
    position: 'top-right',
    timer: 5000
})

window.Bus = new Vue()
