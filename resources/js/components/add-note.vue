<template>
    <div class="pl-md-4">
        <form>
            <h5 class="mb-3">Add Note</h5>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Note..." v-model="note"></textarea>
                <div class="invalid-feedback" v-show="error.note !== ''" :class="{ 'd-block': error.note !== '' }">
                    {{ error.note }}
                </div>
            </div>
            <div class="form-group">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item" v-for="_category of categories">
                        <span class="category" :class="[{ active: (category !== null && category.id === _category.id), disabled: ( isLimitedCategory() && limitCategory !== _category.id) }, _category.color]" @click="setCategory(_category)" v-b-tooltip.hover :title="_category.name"></span>
                    </li>
                </ul>
                <div class="invalid-feedback" v-show="error.category_id !== ''" :class="{ 'd-block': error.category_id !== '' }">
                    {{ error.category_id }}
                </div>
            </div>
            <div class="form-group">
                <button type="button" class="btn btn-primary btn-sm btn-block" @click="add()" :disabled="!validated()">Add</button>
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
                limitCategory: null,
                error: {
                    note: '',
                    category_id: ''
                }
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
            setCategoryLimit(id) {
                this.limitCategory = id
            },
            categoryId() {
                let id = null
                
                if (this.category !== null) {
                    id = this.category.id
                }
                
                return id
            },
            setCategory(category) {
                if ( ! this.isLimitedCategory() || (this.isLimitedCategory() && this.limitCategory === category.id)) {
                    if (this.categoryId() === category.id) {
                        this.category = null
                    } else {
                        this.category = category
                    }
                }
            },
            isLimitedCategory() {
                return this.limitCategory !== null && this.limitCategory !== ''
            },
            clearErrors() {
                this.error = {
                    note: '',
                    category_id: ''
                }
            },
            setErrors(response) {
                if (response.data.errors) {
                    for (let property in response.data.errors) {
                        if (response.data.errors[property][0]) {
                            this.error[property] = response.data.errors[property][0]
                        }
                    }
                }
            },
            resetForm() {
                this.note = ''
                this.category = null
            },
            validated() {
                return this.note !== '' && this.category !== null
            },
            add() {
                axios
                    .post('/notes/store', {
                        note: this.note,
                        category_id: this.categoryId()
                    })
                    .then(response => {
                        this.clearErrors()
                        this.setErrors(response)
                        this.resetForm()
                        this.$root.$emit('add-note', response)
                    })
                    .catch(error => {
                        this.clearErrors()
                        this.setErrors(error.response)
                    })
            }
        },
        mounted() {
            this.loadCategories()
            
            this.$root.$on('category-filter', (id) => {
                this.setCategoryLimit(id)
                this.category = null
            })
        }
    }
</script>