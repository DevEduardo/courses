<template>
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
                Guardar datos
            </button>
            <button 
                type="button" 
                class="btn btn-secondary btn-md"
                v-bind:disabled="loading"
            >Cancelar</button>
        </div>
    </form>
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
