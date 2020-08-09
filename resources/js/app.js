require('./bootstrap');

window.Vue = require('vue');
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import VueToastr2 from 'vue-toastr-2';
import 'vue-toastr-2/dist/vue-toastr-2.min.css'
 
window.toastr = require('toastr')
 
Vue.use(VueToastr2)
Vue.use(VueSweetalert2);

Vue.component('student-form', require('./components/StudentFormComponent.vue').default);
Vue.component('student-create', require('./components/StudentCreateComponent.vue').default);
Vue.component('student-list', require('./components/StudentsListComponent.vue').default);
Vue.component('student-show', require('./components/StudentShowComponent.vue').default);

Vue.component('course-list', require('./components/CourseListComponent.vue').default);
Vue.component('course-show', require('./components/CourseShowComponent.vue').default);
Vue.component('course-create', require('./components/CourseCreateComponent.vue').default);



const app = new Vue({
    el: '#app',
    components: {
        'student-form': 'student-form'
    }
});
