<template>
    <div class="note-list">
        <h5 class="mb-3">Notes</h5>
        <p v-show="notes.length == 0">No notes to display.</p>
        <draggable v-model="notes" @update="saveOrder()">
            <div class="card text-white mb-3 mb-sm-4" :class="note.category.color" v-for="(note, i) in notes">
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
        </draggable>
    </div>
</template>
<script>
    import draggable from 'vuedraggable'
    
    export default {
        name: 'note-list',
        components: {
            draggable
        },
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
            },
            saveOrder() {
                let order = []
                
                for (let i=0; i<this.notes.length; i++) {
                    order.push(this.notes[i].id)
                }
                
                axios
                    .get('/notes/order', { params: { order } })
                    .then(response => {
                        // Do nothing
                    })
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