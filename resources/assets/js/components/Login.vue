<template>
    <form>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" v-model="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" v-model="password" class="form-control">
        </div>
        <button class="btn btn-primary" @click.prevent="onSubmit" type="submit">Login</button>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            onSubmit () {
                axios.post('/api/user/login', {
                    email: this.email,
                    password: this.password
                }, {headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }}).then((response) => {
                    const token = response.data.token;
                    const base64Url = token.split('.')[1];
                    const base64 = base64Url.replace('-', '+').replace('_', '/');
                    console.log(JSON.parse(window.atob(base64)));
                    localStorage.setItem('token', token);
                }).catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>