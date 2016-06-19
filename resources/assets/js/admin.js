var Vue = require('vue');

Vue.use(require('vue-resource'));

new Vue({
    el: '#app',

    data: function () {
        return {
            question: '',
            answers: [],
            lock: null
        };
    },

    watch: {
        question: function (question) {
            clearTimeout(this.lock);
            this.lock = setTimeout(function () {
                question && this.$http.get('/admin/answers', {q: question}).then(function (response) {
                    this.$set('answers', response.data);
                });
            }.bind(this), 1000);
        }
    },

    methods: {
        add: function () {
            this.$http.post('/admin/question', {
                _token: window.csrf,
                question: this.question,
                answers: this.answers
            }).then(function () {
                this.question = '';
                this.answers = [];
            });
        }
    }
});
