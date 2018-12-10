<template>
    <div>
        <form>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Add a note..." v-model="note"></textarea>
                <div class="invalid-feedback" v-show="error.note !== ''" :class="{ 'd-block': error.note !== '' }">
                    {{ error.note }}
                </div>
            </div>
            <div class="form-group">
                <ul class="list-inline">
                    <li class="list-inline-item" v-for="_category of categories">
                        <span class="category" :class="[{ active: (category !== null && category.id === _category.id) }, _category.color]" @click="setCategory(_category)" v-b-tooltip.hover :title="_category.name"></span>
                    </li>
                </ul>
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-sm btn-block" @click="add()">Add</button>
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
                categories: [],
                error: {
                    note: ''
                },
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
            },
            add() {
                axios
                    .post('/notes/store', {
                        note: this.note
                    })
                    .then(response => {
                        this.reset();

                        if (response.data.error) {
                            for (let property in response.data.error) {
                                if (response.data.error[property][0]) {
                                    this.error[property] = response.data.error[property][0];
                                }
                            }
                        }
                    })
            }
        },
        mounted() {
            this.loadCategories()
        }
    }
</script>