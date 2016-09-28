<style>

</style>

<template>
    <div class="page">
        <h1 class="entry-title">{{ page.title.rendered }}</h1>

        <h2>With a different template this time ...</h2>

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