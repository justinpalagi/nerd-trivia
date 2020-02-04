<?php

namespace App\Factories\QuestionFactories;

use App\Factories\IQuestionFactory;
use App\Question;

/** 
 * This is an example of a harcoded Question Factory
 */
class PeriodicTableQF implements IQuestionFactory
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
        $tempQuestion->question = "What is the 6th element in the periodic table?";
        $tempQuestion->answer = "Carbon";
        $tempQuestion->category = "periodic";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "What is the symbol for Manganese?";
        $tempQuestion->answer = "Mn";
        $tempQuestion->category = "periodic";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "What element category is Cesium?";
        $tempQuestion->answer = "Alkali metal";
        $tempQuestion->category = "periodic";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "What is the lightest Noble Gas?";
        $tempQuestion->answer = "Helium";
        $tempQuestion->category = "periodic";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "What is the rarest element on Earth?";
        $tempQuestion->answer = "Francium";
        $tempQuestion->category = "periodic";

        $this->questions->push($tempQuestion);

        $tempQuestion = new Question();
        $tempQuestion->question = "What is the only letter not present on the periodic table?";
        $tempQuestion->answer = "J";
        $tempQuestion->category = "periodic";

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