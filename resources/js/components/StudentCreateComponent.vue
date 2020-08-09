<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info mb-3 mt-3">
                    <div class="card-header">REGISTRAR ESTUDIANTE</div>

                    <div class="card-body">
                        <student-form></student-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                loading: false,
                errors: false,
                form: {}
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
