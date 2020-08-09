<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">ESTUDIANTES REGISTRADOS</div>

                    <div class="card-body">
                        <a href="/student-create" class="btn btn-sm btn-primary mb-3">
                            Nuevo 
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Apellido</th>
                                        <th scope="col">Edad</th>
                                        <th scope="col">Correo</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="student in students" :key="student.id">
                                        <th scope="row">{{ student.id }}</th>
                                        <td>{{ student.name }}</td>
                                        <td>{{ student.lastName }}</td>
                                        <td>{{ student.age }}</td>
                                        <td>{{ student.email }}</td>
                                        <td><a v-bind:href="`/students/${student.id}`" class="btn btn-success">Ver</a></td>
                                    </tr>
                                </tbody>
                            </table>
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
            students: {
                type: Array,
                required: true
            }
        },
        data: function () {
            return {
                loading: false,
                errors: false,
                form: {}
            }
        }
    }
</script>

<style lang="css">
    .thead-dark {
        color:#353b48;
        background-color: #718093;
    }

    .btn-primary {
        color:#2f3640;
        background-color: #0097e6;
        border: 1px solid #0097e6;
    }
</style>
