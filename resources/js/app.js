require('./bootstrap');

window.Vue = require('vue');
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);

Vue.component('student-form', require('./components/StudentFormComponent.vue').default);
Vue.component('student-create', require('./components/StudentCreateComponent.vue').default);
Vue.component('student-list', require('./components/StudentsListComponent.vue').default);
Vue.component('student-show', require('./components/StudentShowComponent.vue').default);

const app = new Vue({
    el: '#app',
    components: {
        'student-form': 'student-form',
        'student-form-edit': 'student-form-edit'
    }
});
