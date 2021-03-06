var pageMixin = {
    ready() {
        this.getPage();
    },

    data() {
        return {
            page: {
                id: 0,
                slug: '',
                title: { rendered: '' },
                content: { rendered: '' }
            }
        }
    },

    methods: {
        getPage() {
            this.$http.get(wp.root + 'wp/v2/pages/' + this.$route.postId).then(function(response) {
                this.page = response.data;
                this.$dispatch('page-title', this.page.title.rendered);
            }, function(response) {
                console.log(response);
            });
        }
    },

    route: {
        canReuse() {
            return false;
        }
    }
};
export default pageMixin;