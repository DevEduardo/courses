<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4" v-for="course in courses" :key="course.id">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">{{ course.courses.name | upper }}</div>

                    <div class="card-body">
                        <div class="rounded-circle">
                            <h1>{{ course.student }}</h1>
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
        filters: {
            upper: function (value) {
                return value.toUpperCase();
            }
        }
    }
</script>

<style lang="css">
    .rounded-circle {
        border-radius: 50%;
        border: 30px solid #78e08f;
        padding: 4px
    }
</style>
