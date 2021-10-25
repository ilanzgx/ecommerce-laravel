import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
Vue.component('Link', Link)
Vue.prototype.$route = route

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})