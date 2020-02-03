<?php

namespace App\Repositories\Contracts;

use App\Game;
use App\Question;

interface IGameRepository extends IBaseRepository
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
    public function createQuestion(Question $questionData);

    /** 
     * Query database for matching questions
     * 
     * @param long game_id
     * @param long question_id
     * @return Question
     */
    public function getAnswer($gameId, $questionId);

    /** 
     * Query database for matching game
     * 
     * @param long game_id
     * @return Game
     */
    public function getGame($gameId);

    /** 
     * Generate and set unique user friendly code
     * 
     * @param Game game
     * @return void
     */
    public function setCode(Game $game);
}