<template>
    <div class="pl-md-4 mb-4">
        <form>
            <h5 class="mb-3">Filter Notes</h5>
            <div class="form-group">
                <select class="form-control" v-model="id">
                    <option value="">All Categories</option>
                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                </select>
            </div>            
        </form>
    </div>
</template>
<script>
    export default {
        name: 'note-filter',
        data() {
            return {
                id: '',
                categories: []
            }
        },
        methods: {
            loadCategories() {
                axios
                    .get('/categories/index')
                    .then(response => {
                        this.categories = response.data.data
                    })
            },
        },
        watch: {
            id: function(value) {
                this.$root.$emit('category-filter', value)
            }
        },
        mounted() {
            this.loadCategories()
        }
    }
</script>