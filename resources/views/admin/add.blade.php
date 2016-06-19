<!DOCTYPE html>
<html>
    <head>
        <title>Un Google en Or - Admin</title>
        <style>
            [v-cloak] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="container" id="app" v-cloak>
            <input type="text" v-model="question" />
            <ol>
                <li v-for="answer in answers">{{ answer }}</li>
            </ol>
            <button v-on:click="add" :disabled="!question || !answers.length">Ajouter</button>
        </div>
        @include ('variables')
        <script type="text/javascript" src="<< elixir('js/admin.js') >>"></script>
    </body>
</html>

