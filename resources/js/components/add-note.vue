<template>
    <div class="pl-lg-4">
        <form>
            <div class="form-group">
                <textarea class="form-control" rows="3" placeholder="Add a note..." v-model="note"></textarea>
                <div class="invalid-feedback" v-show="error.note !== ''" :class="{ 'd-block': error.note !== '' }">
                    {{ error.note }}
                </div>
            </div>
            <div class="form-group">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item" v-for="_category of categories">
                        <span class="category" :class="[{ active: (category !== null && category.id === _category.id) }, _category.color]" @click="setCategory(_category)" v-b-tooltip.hover :title="_category.name"></span>
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
            categoryId() {
                let id = null
                
                if (this.category !== null) {
                    id = this.category.id
                }
                
                return id
            },
            setCategory(category) {
                if (this.categoryId() === category.id) {
                    this.category = null
                } else {
                    this.category = category
                }
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
                    })
                    .catch(error => {
                        this.clearErrors()
                        this.setErrors(error.response)
                    })
            }
        },
        mounted() {
            this.loadCategories()
        }
    }
</script>