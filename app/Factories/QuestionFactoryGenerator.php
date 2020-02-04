<?php

namespace App\Factories;

use App\Factories\QuestionFactories\GameOfThronesQF;
use App\Factories\QuestionFactories\PeriodicTableQF;
use Exception;

class QuestionFactoryGenerator
{
    /** 
     * Generates a question factory
     * 
     * @return IQuestionFactory
     * @param string $category
     */
    public static function run($category)
    {
        switch($category)
        {
            case "periodic":
                return new PeriodicTableQF();
            case "got":
                return new GameOfThronesQF(); 
            //case "marvel":
            //    return new MarvelQF();
            default:
                throw new Exception("Category not found");
        }
    }
}
