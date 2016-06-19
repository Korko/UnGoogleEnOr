var Vue = require('vue');

window.levenshtein = require('fast-levenshtein');

new Vue({
    el: '#app',

    data: function() {
        return {
            question: window.question,
            answers: this.formatAnswers(window.answers),
            errors: 0,
            newError: false,
            suggestion: ''
        };
    },

    computed: {
        found: function() {
            var total = 0;
            for(var index in this.answers) {
                if(this.answers[index].found) total++;
            }
            return total;
        },
        score: function() {
            return this.found - this.errors;
        },
        gameLost: function() {
            return this.errors >= 3;
        },
        gameWon: function() {
            return this.found >= this.answers.length;
        },
        gameEnded: function() {
            return this.gameLost || this.gameWon;
        }
    },

    watch: {
        errors: function(errors) {
            clearTimeout(this.newError);
            this.newError = setTimeout(function() {
                this.newError = false;
            }.bind(this), 1500);
        }
    },

    methods: {
        formatAnswers: function(answers) {
            var formatedAnswers = [];
            for(var index in answers) {
                formatedAnswers.push({text: answers[index], found: false});
            }
            return formatedAnswers;
        },
        guess: function() {
            for(var index in this.answers) {

		var answer = this.answers[index].text.toUpperCase();
		var guess = this.suggestion.toUpperCase();

                if(answer === guess || (levenshtein.get(answer, guess) <= answer.length/3)) {
                    this.answers[index].found = true;
                    this.suggestion = '';
                    return;
                }
            }
            this.errors++;
            this.suggestion = '';
        }
    } 
});
