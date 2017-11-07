<template>
    <div class="panel panel-default">
        <div class="panel-body">
            {{ qt.content }}
        </div>
        <div class="panel-footer">
            <div v-if="editing">
                <input type="text" v-model="editValue">
                <a @click="onUpdate">Save</a>
                <a @click="onCancel">Cancel</a>
            </div>
            <div v-else>
                <a @click="onEdit">Edit</a>
                <a @click="onDelete">Delete</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['qt'],
        data() {
            return {
                editing: false,
                editValue: this.qt.content
            };
        },
        methods: {
            onEdit() {
                this.editing = true;
                this.editValue = this.qt.content;
            },
            onCancel() {
                this.editing = false;
            },
            onUpdate() {
                this.editing = false;
                let vm = this;
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');
                axios.put('/api/quote/' + this.qt.id, {
                    content: this.editValue,
                })
                    .then((response) => {
                        vm.qt.content = vm.editValue;
//                        vm.$emit('onEdited');
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            onDelete() {
                let vm = this;
                axios.delete('/api/quote/' + this.qt.id + "?token=" + localStorage.getItem('token'))
                    .then((response) => {
                        vm.$emit('quoteDeleted', this.qt.id);
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>
    a {
        cursor: pointer;
    }
</style>