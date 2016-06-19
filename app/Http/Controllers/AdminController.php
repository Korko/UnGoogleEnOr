<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Question;

class AdminController extends Controller
{
    public function getAnswers (Request $request)
    {
        $question = $request->input('q');
        $rawAnswers = $this->getRemoteAnswers($question);

        $answers = [];
        foreach($rawAnswers as $rawAnswer) {
            $rawAnswer = str_replace($question, '', $rawAnswer);
            $rawAnswer = trim($rawAnswer);
            if(strpos($rawAnswer, ' ') === FALSE) {
                $answers[] = $rawAnswer;
            }
        }
        $answers = array_unique($answers);

        return $answers;
    }

    protected function getRemoteAnswers ($question)
    {
        $json = file_get_contents('https://www.google.com/complete/search?'.http_build_query([
            'output' => 'chrome',
            'q' => $question,
            'hl' => 'fr'
        ]));

        return json_decode(utf8_encode($json), TRUE)[1];
    }

    public function doAddQuestion (Request $request)
    {
        $qtext = $request->input('question');
        $atexts = $request->input('answers');

        $question = new Question();
        $question->text = $qtext;
        $question->slug = str_slug($question->text);
        $question->save();

        $answers = [];
        foreach ($atexts as $atext) {
            $answers[] = ['text' => $atext];
        }
        $question->answers()->createMany($answers);
    }

    public function doDeleteQuestion (Question $question)
    {
        Question::delete($question);
    }
}
