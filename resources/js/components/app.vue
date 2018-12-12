<template>
    <div id="root">
        <nav class="navbar navbar-light bg-light mb-3">
            <a href="/" class="navbar-brand">Note</a>
        </nav>
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4 offset-md-1 offset-lg-2">
                <note-list></note-list>
            </div>
            <div class="col-sm-12 col-md-5 col-lg-4">
                <add-note></add-note>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    import BootstrapVue from 'bootstrap-vue'
    
    Vue.use(BootstrapVue)
</script>