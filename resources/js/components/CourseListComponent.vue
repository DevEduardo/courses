<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">CURSOS</div>

                    <div class="card-body">
                        <a href="/course-create" class="btn btn-sm btn-primary mb-3">
                            Nuevo 
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomre</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col">Fecha de inicio</th>
                                        <th scope="col">Fecha de culminacion</th>
                                        <th scope="col">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="course in courses" :key="course.id">
                                        <th scope="row">{{ course.id }}</th>
                                        <td>{{ course.name }}</td>
                                        <td>{{ course.schedule }}</td>
                                        <td>{{ course.starDate }}</td>
                                        <td>{{ course.endDate }}</td>
                                        <td><a v-bind:href="`/courses/${course.id}`" class="btn btn-success">Ver</a></td>
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
            courses: {
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
