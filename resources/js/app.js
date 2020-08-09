require('./bootstrap');

window.Vue = require('vue');
import { ValidationProvider, ValidationObserver  } from 'vee-validate';

Vue.component('ValidationProvider', ValidationProvider);
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('student-create', require('./components/StudentCreateComponent.vue').default);

const app = new Vue({
    el: '#app',
});
