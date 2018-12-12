<template>
    <div class="note-list">
        <h5 class="mb-3">Notes</h5>
        <div class="row">
            <div class="col-sm-6 col-lg-4" v-for="(note, i) in notes">
                <div class="card text-white mb-3 mb-sm-4" :class="note.category.color">
                    <div class="card-header">
                        {{ note.category.name }}
                        <button type="button" class="close text-white" @click="destroy(note)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">{{ note.note }}</div>
                    <div class="card-footer">
                        <span class="small">{{ note.created_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'note-list',
        data() {
            return {
                notes: []
            }
        },
        methods: {
            load() {
                axios
                    .get('/notes/index')
                    .then(response => {
                        this.notes = response.data.data
                    })
            },
            destroy(note) {
                if (confirm('Are you sure?')) {
                    axios
                        .get('/notes/destroy/' + note.id)
                        .then(response => {
                            this.notes = this.notes.filter(item => item.id != note.id)
                        })
                }
            }
        },
        mounted() {
            this.load()
            
            this.$root.$on('add-note', (response) => {
                if (response.data) {
                    this.notes.push(response.data.data)
                }
            })
        }
    }
</script>