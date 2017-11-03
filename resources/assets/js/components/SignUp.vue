<template>
    <form>
        <div class="form-group">
            <label for="username">Usernane</label>
            <input id="username" type="text" name="username" class="form-control" v-model="username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" class="form-control" v-model="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" class="form-control" v-model="password">
        </div>
        <button type="submit" class="btn btn-primary" @click.prevent="onSubmit">Sign Up</button>
    </form>
</template>

<script>
    export default {
        data () {
            return {
                username: '',
                email: '',
                password: '',
            };
        },
        methods: {
            onSubmit ()
            {
                axios.post('/api/user', {
                    name: this.username,
                    email: this.email,
                    password: this.password
                },
                {headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }}).then((response) => {

                }).catch((error) => {

                });
            }
        }
    }
</script>