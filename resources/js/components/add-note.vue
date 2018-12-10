<template>
    <div>
        <form>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Add a note..." v-model="note"></textarea>
            </div>
            <div class="form-group">
                <ul class="list-inline">
                    <li class="list-inline-item" v-for="_category of categories">
                        <span class="category" :class="[{ active: (category !== null && category.id === _category.id) }, _category.color]" @click="setCategory(_category)" v-b-tooltip.hover :title="_category.name"></span>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm btn-block" :disabled="!validated()">Add</button>
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
                category: null,
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
            },
            setCategory(category) {
                if (this.category !== null && this.category.id === category.id) {
                    this.category = null
                } else {
                    this.category = category
                }
            },
            validated() {
                return this.note !== '' && this.category !== null
            }
        },
        mounted() {
            this.loadCategories()
        }
    }
</script>