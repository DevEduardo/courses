<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">DATOS</div>

                    <div class="card-body">
                        <div v-if="!isUpdate">
                            <p><b>Nombre:</b> {{ course.name | upper }}</p>
                            <p><b>Horario:</b> {{ course.schedule | upper }}</p>
                            <p><b>Fecha de inicio:</b> {{ course.starDate | upper }}</p>
                            <p><b>Fecha de culminación:</b> {{ course.endDate | upper }}</p>
                        </div>
                        <form
                            novalidate
                            v-if="isUpdate"
                            @submit.prevent="submit()"
                            >
                            <div class="form-group">
                                <label for="name">Nomre</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="name" 
                                        placeholder="Nombre del curso"
                                        v-model="form.name"
                                        v-bind:disabled="loading"
                                    >
                                    <p class="text-danger" v-if="errors.name">
                                        {{ errors.name[0]}}
                                    </p>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="starHour">Hora de inicio</label>
                                        <input 
                                            type="time" 
                                            class="form-control" 
                                            id="starHour" 
                                            placeholder="Hora de culminación"
                                            v-model="form.starHour"
                                            v-bind:disabled="loading"
                                        >
                                    </div>
                                    <div class="col-md-6">
                                        <label for="endHour">Hora de culminación</label>
                                        <input 
                                            type="time" 
                                            class="form-control" 
                                            id="endHour" 
                                            placeholder="Hora de culminación"
                                            v-model="form.endHour"
                                            v-bind:disabled="loading"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <label for="starDate">Fecha de inicio</label>
                                        <datepicker 
                                            name = "starDate"
                                            id = "starDate"
                                            input-class = "form-control"
                                            v-model="form.starDate"
                                            :format = "customFormatter"
                                            @input="changeStartDate($event)">
                                        </datepicker>
                                        <p class="text-danger" v-if="errors.starDate">
                                            {{ errors.starDate[0]}}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="endDate">Fecha de culminación</label>
                                        <datepicker 
                                            name = "endDate"
                                            id = "endDate"
                                            input-class = "form-control"
                                            v-model="form.endDate"
                                            :format = "customFormatter"
                                            @input="changeEndDate($event)">
                                        </datepicker>
                                        <p class="text-danger" v-if="errors.endDate">
                                            {{ errors.endDate[0]}}
                                        </p>
                                    </div>
                                </div>
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
                                    Guardar datos
                                </button>
                                <button 
                                    type="button" 
                                    class="btn btn-secondary btn-md"
                                    v-bind:disabled="loading"
                                >Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center" v-if="!isUpdate">
                        <a href="/course-create" class="btn btn-md btn-success mb-3">
                            Inscribir 
                        </a>
                        <a @click="edit()" class="btn btn-md btn-info mb-3">
                            Editar 
                        </a>
                        <a @click="courseDelete()" class="btn btn-md btn-danger mb-3">
                            Eliminar 
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">ESTUDIANTES INSCRITOS</div>

                    <div class="card-body">
                        {{ course.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker';
    import moment from 'moment';
    import VueTimepicker from 'vue2-timepicker/src/vue-timepicker.vue';

    export default {
        components: {
            Datepicker,
            VueTimepicker
        },
        props: {
            course: {
                type: Object,
                required: true
            }
        },
        data: function () {
            return {
                loading: false,
                isUpdate: false,
                errors: false,
                form: this.course
            }
        },
        methods: {
            edit: function () {
                this.isUpdate = true
                this.form.starHour = this.starHour(this.course.schedule)
                this.form.endHour = this.endHour(this.course.schedule)
            },
            submit: function () {
                this.loading = true;
                this.form.schedule = this.form.starHour+'-'+ this.form.endHour
                axios.put(`/courses/${this.course.id}`,  this.form)
                    .then((res) => {
                        if (res.status) {
                            this.$toastr.success('Curso actualizado', 'Accion exitosa!');
                            this.loading = false;
                            this.isUpdate = false
                        }
                    })
                    .catch((err) => {
                        if (err.response.status === 403 || err.response.status === 405) {
                            location.href = '/';
                        }
                        this.errors = err.response.data.errors
                        this.loading = false;
                    })
                ;
            },
            courseDelete: function () {
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
                        axios.delete(`/courses/${this.course.id}`)
                        .then((res) => {
                            if (res.status) {
                                this.$toastr.success('Curso eliminado', 'Accion exitosa!');
                                this.loading = false;
                                this.isUpdate = false;
                                location.href = '/courses/';
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
            changeStartDate: function (date) {
                let day = (date.getDate() < 10) ? '0' + date.getDate() : date.getDate();
                let month = ((date.getMonth() + 1) < 10) ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
                let year = date.getFullYear();

                this.form.starDate = year + '-' + month + '-' + day;
                this.disabledDates = { 
                        to : moment(date).format('DD/MM/yyyy')
                }
            },
            changeEndDate: function (date) {
                let day = (date.getDate() < 10) ? '0' + date.getDate() : date.getDate();
                let month = ((date.getMonth() + 1) < 10) ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
                let year = date.getFullYear();

                this.form.endDate = year + '-' + month + '-' + day;
            },
            customFormatter(date) {
                return moment(date).format('DD/MM/yyyy');
            },
            starHour: function (hour) {
                const starHour = hour.split('-')
                return starHour[0]
            },
            endHour: function (hour) {
                const endHour = hour.split('-')
                return endHour[1]
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
