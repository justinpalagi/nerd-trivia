<?php

namespace App\Factories\QuestionFactories;

use App\Factories\IQuestionFactory;
use App\Question;

/** 
 * This is an example of a harcoded Question Factory
 */
class GameOfThronesQF implements IQuestionFactory
{
    /**
     *  Populate Question array
     * 
     * @return void
     */
    public function __construct()
    {
        $this->questions = collect();

        $tempQuestion = new Question();
        $tempQuestion->question = "What did John Snow name his direwolf?";
        $tempQuestion->answer = "Ghost";
        $tempQuestion->category = "got";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "How many direwolf pups were found?";
        $tempQuestion->answer = "6";
        $tempQuestion->category = "got";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "Where was Theon Greyjoy originally from?";
        $tempQuestion->answer = "Iron Islands";
        $tempQuestion->category = "got";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "Who was Daenerys Targaryen's first husband?";
        $tempQuestion->answer = "Khal Drogo";
        $tempQuestion->category = "got";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "Who was Cersei Lannister's younget son?";
        $tempQuestion->answer = "Tommen Baratheon";
        $tempQuestion->category = "got";

        $this->questions->push($tempQuestion);

        $this->questions = $this->questions->random($this->questions->count());
    }

    /** 
     * Generates a random question
     * 
     * @return Question
     */
    public function getQuestion()
    {
        return $this->questions->pop();
    }

    /**
     * 
     * @var array
     */
    protected $questions;
}