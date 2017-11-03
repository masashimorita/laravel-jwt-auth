<template>
    <div>
        <button class="btn btn-primary" @click="onGetQuotes">Get Quotes</button>
        <hr>
        <app-quote v-for="quote in quotes" :qt="quote" @quoteDeleted="onQuoteDeleted($event)"></app-quote>
    </div>
</template>

<script>
    import Quote from './Quote.vue';
    export default {
        data () {
            return {
                quotes: []
            };
        },
        methods: {
            onGetQuotes () {
                let vm = this;
                axios.get('/api/quotes')
                    .then((response) => {
                        vm.quotes = response.data.quotes;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            onQuoteDeleted (id) {
                const position = this.quotes.findIndex((element) => {
                    return element.id === id;
                });
                this.quotes.splice(position,1);
            }
        },
        components: {
            'app-quote': Quote
        }
    }
</script>