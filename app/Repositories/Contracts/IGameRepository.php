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
     * @param int $gameId
     * @param int $questionId
     * @return Question
     */
    public function getAnswer($gameId, $questionId);

    /** 
     * Query database for matching game
     * 
     * @param int $gameCode
     * @return Game
     */
    public function getGameByCode($gameCode);

    /** 
     * Query database for matching game
     * 
     * @param int $gameId
     * @return Game
     */
    public function getGameById($gameId);

    /** 
     * Generate and set unique user friendly code
     * 
     * @param Game $game
     * @return void
     */
    public function setCode(Game $game);
}