<template>
    <div class="row">
        <div class="col-sm-4" v-for="note in notes">
            <div class="card text-white" :class="note.category.color">
                <div class="card-header">{{ note.category.name }}</div>
                <div class="card-body">{{ note.note }}</div>
                <div class="card-footer">
                    <span class="small">{{ note.created_at }}</span>
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
            }
        },
        mounted() {
            this.load()
        }
    }
</script>