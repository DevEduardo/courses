<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4" v-for="course in courses" :key="course.id">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">{{ course.courses.name | upper }}</div>

                    <div class="card-body text-center">
                        <div class="rounded-circle ">
                            <h1>{{ course.student }}</h1>
                        </div>
                        <p class="student">ESTUDIANTES</p>
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
        filters: {
            upper: function (value) {
                return value.toUpperCase();
            }
        }
    }
</script>

<style lang="css">
    .rounded-circle {
        height: 100px;
        width: 100px;
        display: table-cell;
        text-align: center;
        font-size:36px;
        vertical-align: middle;
        border-radius: 50%;
        border: 5px solid #78e08f;
    }
    .student {
        position: absolute;
        right: 100px;
        top: 100px;
    }
</style>
