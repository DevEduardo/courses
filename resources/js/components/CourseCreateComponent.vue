<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">REGISTRAR CURSO</div>

                    <div class="card-body">
                        <form
                            novalidate
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
        data: function () {
            return {
                loading: false,
                errors: false,
                form: {},
                disabledDates : { }
            }
        },
        methods: {
            submit: function () {
                this.loading = true;
                this.form.schedule = this.form.starHour+'-'+ this.form.endHour
                axios.post('/courses/',  this.form)
                    .then((res) => {
                        if (res.status) {
                            this.$toastr.success('Curso creado', 'Accion exitosa!');
                            this.loading = false;
                            location.href = res.request.responseURL;
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
            customFormatterTimer(date) {
                return moment(date).format('h: mm: ss a');
            }
        },
    }
</script>

<style lang="css">
    .card-header {
        color: #fff;
        background-color: #40739e;
    }
</style>
