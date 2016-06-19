<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use Redirect;
use View;

use App\Answers;
use App\Question;

class GameController extends Controller
{
    public function random ()
    {
        $question = Question::orderByRaw("RAND()")->first();
        return redirect()->route('play', [$question->slug]);
    }

    public function play (Question $question)
    {
        JavaScript::put([
                'question' => $question->text,
                'answers' => $question->answers->pluck('text')
        ]);
        return view('game');
    }

/*
        $question = 'comment savoir si je suis';
	$rawAnswers = $this->getAnswers($question);

	$answers = [];
        foreach($rawAnswers as $rawAnswer) {
            $rawAnswer = str_replace($question, '', $rawAnswer);
            $rawAnswer = trim($rawAnswer);
            if(strpos($rawAnswer, ' ') === FALSE) {
                $answers[] = $rawAnswer;
            }
        }
        $answers = array_unique($answers);
        $answers = array_slice($answers, 0, 10);


    protected function getAnswers($question) {
        $json = file_get_contents('http://www.google.com/complete/search?'.http_build_query([
            'output' => 'chrome',
            'q' => $question,
            'hl' => 'fr'
        ]));

        return json_decode(utf8_encode($json), TRUE)[1];
    }
*/
}
