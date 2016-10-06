<style>

</style>

<template>
    <div class="page">
        <h1 class="entry-title">{{{ page.title.rendered }}}</h1>

        <div class="entry-content">
            {{{ page.content.rendered }}}
        </div>
    </div>
</template>

<script>
    import pageMixin from './mixins/page.js';
    export default{
        mixins:[pageMixin],
    }
</script>