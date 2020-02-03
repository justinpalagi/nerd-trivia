<?php

namespace App\Repositories\Contracts;

use App\Game;
use App\Question;

interface IGameRepository
{
    /** 
     * Save Game to database
     * 
     * @param string ip
     * @return Game
     */
    public function createGame($ip);

    /** 
     * Save Qustion to database
     * 
     * @param 
     * @return Question
     */
    public function createQuestion(Question $question_data);

    /** 
     * Query database for matching questions
     * 
     * @param long game_id
     * @param long question_id
     * @return Question
     */
    public function getAnswer($game_id, $question_id);

    /** 
     * Query database for matching game
     * 
     * @param long game_id
     * @return Game
     */
    public function getGame($game_id);

    /** 
     * Generate and set unique user friendly code
     * 
     * @param Game game
     * @return void
     */
    public function setCode(Game $game);
}