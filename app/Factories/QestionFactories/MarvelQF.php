<?php

namespace App\Factories\QuestionFactories;

use App\Factories\IQuestionFactory;
use App\Question;
use Exception;

/** 
 * This is a mocked Factory for the 
 * https://developer.marvel.com/docs#!
 */
class MarvelQF implements IQuestionFactory
{
    /** 
     * Generates a random question
     * 
     * @return Question
     */
    public function getQuestion()
    {
        throw new Exception("Not Implemented");

        //1. Generate Random Number between 1-100
        //2. Call the GET /v1/public/characters/{randomNumber} API
        //3. Return Question with Answer = character.name, Question = character.description
    }
}