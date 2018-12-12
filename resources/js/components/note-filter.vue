<template>
    <div class="pl-md-4 mb-4">
        <form>
            <h5 class="mb-3">Filter Notes</h5>
            <div class="form-group">
                <select class="form-control" v-model="filter">
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
                filter: '',
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
        mounted() {
            this.loadCategories()
        }
    }
</script>