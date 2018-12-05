<template>
    <div>
        <form>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Add a note..." v-model="note"></textarea>
            </div>
            <div class="form-group">
                <ul class="list-inline">
                    <li class="list-inline-item" v-for="category of categories">
                        <span class="category" :class="category.color"></span>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block">Add</button>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        name: 'add-note',
        data() {
            return {
                note: '',
                categories: []
            }
        },
        methods: {
            loadCategories() {
                axios
                    .get('/categories/ajax')
                    .then(response => {
                        this.categories = response.data
                    })
            }
        },
        mounted() {
            this.loadCategories()
        }
    }
</script>