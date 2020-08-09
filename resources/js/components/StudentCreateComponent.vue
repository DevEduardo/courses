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
        methods: {
            submit: function () {
                this.form.image = this.images
                
                this.loading = true;
                axios.post('/students/',  this.form)
                    .then((res) => {
                        if (res.status) {
                            this.loading = false;
                            $('#element').toast('show')
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
