<!DOCTYPE html>
<html>
    <head>
        <title>Un Google en Or</title>
	<link rel="stylesheet" type="text/css" href="<< elixir('css/app.css') >>" />
    </head>
    <body>
        <div class="container" id="app" v-cloak>
		<span>Erreurs : {{ errors }}</span>
		<p>{{ question | capitalize }}...</p>
		<ol id="answers">
			<li v-for="answer in answers" :class="'answer ' + (answer.found || gameEnded ? 'found' : 'secret')" data-answer="{{ (answer.found || gameEnded ? answer.text : '') | capitalize }}">

			</li>
		</ol>
		<form v-on:submit.prevent="">
			<fieldset :disabled="gameEnded">
				<input type="text" v-model="suggestion" />
				<button v-on:click="guess" :disabled="!suggestion">Deviner</button>
			</fieldset>
		</form>

		<div v-show="gameEnded" transition="fade" class="Modal u-overlay animated">
			<div @click.stop="" v-show="gameEnded" transition="fadeWithMove" class="Modal__container animated">
				<header class="Modal__header">
					<h1 v-if="gameLost">You lost!</h1>
					<h1 v-if="gameWon">You won!</h1>
				</header>

				<div class="Modal__content">
					Your score is: {{ score }}
				</div>

				<footer class="Modal__footer"></footer>
			</div>
		</div>

		<div id="errors" :class="newError ? 'show' : ''">
			<div v-for="n in errors" class="cross"></div>
		</div>
        </div>
        @include ('variables')
	<script type="text/javascript" src="<< elixir('js/main.js') >>"></script>
    </body>
</html>
