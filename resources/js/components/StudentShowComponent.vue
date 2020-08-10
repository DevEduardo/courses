<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">DATOS PERSONALES</div>

                    <div class="card-body">
                        <div v-if="!isUpdate">
                            <p><b>Nombre:</b> {{ student.name | upper }}</p>
                            <p><b>Apellido:</b> {{ student.lastName | upper }}</p>
                            <p><b>Edad:</b> {{ student.age | upper }}</p>
                            <p><b>Correo:</b> {{ student.email | upper }}</p>
                        </div>
                        <form
                            v-if="isUpdate"
                            @submit.prevent="submit()"
                            >
                            <div class="form-group">
                                <label for="name">Nomre</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="name" 
                                        placeholder="Ingrese su nombre compleo"
                                        v-model="form.name"
                                        v-bind:disabled="loading"
                                    >
                                    <p class="text-danger" v-if="errors.name">
                                        {{ errors.name[0]}}
                                    </p>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Apellido</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="lastName" 
                                        placeholder="Ingrese su nombre compleo"
                                        v-model="form.lastName"
                                        v-bind:disabled="loading"
                                    >
                                    <p class="text-danger" v-if="errors.lastName">
                                        {{ errors.lastName[0]}}
                                    </p>
                            </div>
                            <div class="form-group">
                                <label for="age">Edad</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="age" 
                                        placeholder="Ingrese su nombre compleo"
                                        v-model="form.age"
                                        v-bind:disabled="loading"
                                    >
                                    <p class="text-danger" v-if="errors.age">
                                        {{ errors.age[0]}}
                                    </p>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="email" 
                                        placeholder="Ingrese su nombre compleo"
                                        v-model="form.email"
                                        v-bind:disabled="loading"
                                    >
                                    <p class="text-danger" v-if="errors.email">
                                        {{ errors.email[0]}}
                                    </p>
                            </div>
                            <div class="text-center">
                                <button 
                                    type="submit" 
                                    class="btn btn-md btn-primary"
                                    v-bind:disabled="loading"
                                >
                                    <span 
                                        class="spinner-border spinner-border-sm" 
                                        role="status" 
                                        aria-hidden="true"
                                        v-if="loading"
                                    ></span>
                                    Actualizat datos
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-secondary btn-md"
                                    v-bind:disabled="loading"
                                    @click="isUpdate = false"
                                >Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center" v-if="!isUpdate">
                        <button 
                            @click="addCourse()" 
                            class="btn btn-md btn-success mb-3"
                            v-bind:disabled="loading"
                        >
                            Inscribir 
                        </button>
                        <button 
                            @click="edit()" 
                            class="btn btn-md btn-info mb-3"
                            v-bind:disabled="loading"
                        >
                            <span 
                                class="spinner-border spinner-border-sm" 
                                role="status" 
                                aria-hidden="true"
                                v-if="loading"
                            ></span>
                            Editar 
                        </button>
                        <button 
                            @click="studentDelete()" 
                            class="btn btn-md btn-danger mb-3"
                            v-bind:disabled="loading"
                        >
                            Eliminar 
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12" v-if="!isCourses">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">CURSO DE {{ student.name }}</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomre</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col">Fecha de inicio</th>
                                        <th scope="col">Fecha de culminacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="course in studentCoursesList" :key="course.id">
                                        <th scope="row">{{ course.id }}</th>
                                        <td>{{ course.courses.name }}</td>
                                        <td>{{ course.courses.schedule }}</td>
                                        <td>{{ course.courses.starDate }}</td>
                                        <td>{{ course.courses.endDate }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-md-8 col-sm-12" v-if="isCourses">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">CURSOS DISPONIBLES</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomre</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col">Fecha de inicio</th>
                                        <th scope="col">Fecha de culminacion</th>
                                        <th scope="col">Inscribir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="course in courses" :key="course.id">
                                        <th scope="row">{{ course.id }}</th>
                                        <td>{{ course.name }}</td>
                                        <td>{{ course.schedule }}</td>
                                        <td>{{ course.starDate }}</td>
                                        <td>{{ course.endDate }}</td>
                                        <td>
                                            <input 
                                                type="checkbox" 
                                                class="courses"
                                                :value="course.id"
                                                v-model="coursesChecked"
                                            />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="card-footer text-center">
                                <button 
                                    @click="addNewCourse()" 
                                    class="btn btn-md btn-success mb-3" 
                                    v-bind:disabled="loadingCourses"
                                >
                                    <span 
                                        class="spinner-border spinner-border-sm" 
                                        role="status" 
                                        aria-hidden="true"
                                        v-if="loadingCourses"
                                    ></span>
                                    Aceptar 
                                </button>
                                <button 
                                    @click="cancelNewCuorse()" 
                                    class="btn btn-md btn-info mb-3" 
                                    v-bind:disabled="loadingCourses"
                                >
                                    Canelar 
                                </button>
                                <button 
                                    @click="clearCourse()" 
                                    class="btn btn-md btn-danger mb-3" 
                                    v-bind:disabled="loadingCourses"
                                >
                                    Desmarcar todo 
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            student: {
                type: Object,
                required: true
            },
            courses: {
                type: Array,
                required: true
            },
            studying: {
                type: Array,
                required: true
            }
        },
        data: function () {
            return {
                loading: false,
                loadingCourses: false,
                isUpdate: false,
                isCourses: false,
                errors: false,
                form: this.student,
                studentCoursesList: this.studying,
                coursesChecked: [],
                formNewCourse: {}
            }
        },
        methods: {
            edit: function () {
                this.isUpdate = true
            },
            submit: function () {
                this.loading = true;
                axios.put( `/students/${this.student.id}`,  this.form)
                    .then((res) => {
                        if (res.status) {
                            this.loading = false;
                            this.isUpdate = false;
                            this.$toastr.success('Estudiante actualizado', 'Accion exitosa!');

                        }
                    })
                    .catch((err) => {
                        this.errors = err.response.data.errors
                        this.loading = false;
                    })
                ;
            },
            studentDelete: function () {
                this.loading = true;
                this.$swal({
                    title: 'Esta seguro?',
                    text: "No podrás revertir los cambios!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar!'
                    }).then((result) => {
                    if (result.value) {
                        axios.delete(`/students/${this.student.id}`)
                        .then((res) => {
                            if (res.status) {
                                this.$toastr.success('Estudiante eliminado', 'Accion exitosa!');
                                this.loading = false;
                                this.isUpdate = false;
                                location.href = '/students/';
                            }
                        })
                        .catch((err) => {
                            console.log(err)
                            this.errors = err.response.data.errors
                            this.loading = false;
                        });
                    }
                });
                
            },
            addCourse: function () {
                this.isCourses = true
            },
            addNewCourse: function () {
                this.loadingCourses = true;
                this.formNewCourse.student = this.student.id
                this.formNewCourse.coursesChecked = this.coursesChecked
                axios.post( `/studentCourse`,  this.formNewCourse)
                    .then((res) => {
                        if (res.status) {
                            this.loadingCourses = false;
                            this.$toastr.success('Estudiante inscrito', 'Accion exitosa!');
                            this.isCourses = false
                            this.studentCoursesList = res.data.data
                            console.log(res.data.data)
                            console.log(this.studentCoursesList[0])
                        }
                    })
                    .catch((err) => {
                        console.log(err)
                        this.errors = err.response.data.errors
                        this.loading = false;
                    })
                ;
            },
            clearCourse: function () {
               this.coursesChecked = []
            },
            cancelNewCuorse: function () {
                this.isCourses = false
            }
        },
        filters: {
            upper: function (value) {
                return value.toUpperCase();
            }
        }
    }
</script>

<style lang="css">
</style>
