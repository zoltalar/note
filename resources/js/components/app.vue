<template>
    <div id="root">
        <nav class="navbar navbar-light bg-light mb-3">
            <a class="navbar-brand">Note</a>
        </nav>
        <div class="row">
            <div class="col-sm-9">
                1
            </div>
            <div class="col-sm-3">
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