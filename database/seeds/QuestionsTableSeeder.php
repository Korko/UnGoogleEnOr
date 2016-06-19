<?php

use Illuminate\Database\Seeder;

use App\Question;
use App\Answer;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->delete();
        DB::table('answers')->delete();

        $question = new Question();
        $question->text = 'Comment savoir si je suis';
        $question->slug = str_slug($question->text);
        $question->save();

        $question->answers()->createMany([
            ['text' => 'enceinte'],
            ['text' => 'belle'],
            ['text' => 'fertile'],
            ['text' => 'beau'],
            ['text' => 'surdoue'],
            ['text' => 'alcoolique'],
            ['text' => 'anorexique'],
            ['text' => 'bi']
        ]);
    }
}
