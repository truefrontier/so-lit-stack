import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import route from 'ziggy';
import DefaultLayout from './Layouts/Default';
import DefaultTemplate from './Templates/Default';
import DefaultPage from './Pages/Default';

// import { Ziggy } from './ziggy';

// Vue.component('my-component', require('./components/MyComponent.vue'));

Vue.use(InertiaApp);

// Ziggy routing
Vue.prototype.$route = (...args) => route(...args).url();

const app = document.getElementById('app');

new Vue({
  render: (h) =>
    h(InertiaApp, {
      props: {
        initialPage: JSON.parse(app.dataset.page),
        resolveComponent: async (name) => {
          const Statamic = window.Statamic || {};

          const LayoutComponent = await import(`./Layouts/${Statamic.layoutName}`)
            .then((module) => module.default)
            .catch(() => DefaultLayout);

          const TemplateComponent = await import(`./Templates/${Statamic.templateName}`)
            .then((module) => module.default)
            .catch(() => DefaultTemplate);

          const PageComponent = import(`./Pages/${name}`)
            .then((module) => {
              module.default.layout = (h, page) => {
                return h(LayoutComponent, [h(TemplateComponent, [page])]);
              };
              return module.default;
            })
            .catch(() => {
              DefaultPage.layout = (h, page) => {
                return h(LayoutComponent, [h(TemplateComponent, [page])]);
              };
              return DefaultPage;
            });

          return PageComponent;
        },
      },
    }),
}).$mount(app);
