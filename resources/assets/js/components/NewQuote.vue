<template>
    <form @submit.prevent="onSubmitted">
        <div class="form-group">
            <label for="content">Content</label>
            <input type="text" id="content" class="form-control" v-model="quoteContent">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</template>

<script>
    export default {
        data () {
            return {
                quoteContent: '',
            };
        },
        methods: {
            onSubmitted() {
                let vm = this;
                axios.post('/api/quote',{content: this.quoteContent, token: localStorage.getItem('token')})
                    .then((response) => {
                        console.log(response);
                        vm.quoteContent = '';
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>