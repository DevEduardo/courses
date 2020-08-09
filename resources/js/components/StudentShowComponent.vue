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
                        <a href="/student-create" class="btn btn-md btn-success mb-3">
                            Inscribir 
                        </a>
                        <a @click="edit()" class="btn btn-md btn-info mb-3">
                            Editar 
                        </a>
                        <a @click="studentDelete()" class="btn btn-md btn-danger mb-3">
                            Eliminar 
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">CURSO DE {{ student.name }}</div>

                    <div class="card-body">
                        {{ student.name }}
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
            }
        },
        data: function () {
            return {
                loading: false,
                isUpdate: false,
                errors: false,
                form: this.student
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
