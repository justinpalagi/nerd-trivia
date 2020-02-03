<?php

namespace App\Repositories;

use Exception;
use App\Game;
use App\Question;
use Carbon\Carbon;
use App\Repositories\Contracts\IGameRepository;

class GameRepository extends BaseEloquentRepository implements IGameRepository
{
    /** 
     * Save Game to database
     * 
     * @param string ip
     * @return Game
     */
    public function createGame($ip)
    {
        $newGame = new Game;

        $newGame->create_at = Carbon::now('UTC');
        $newGame->ip = $ip;

        $newGame->save();

        return $newGame;
    }

    /** 
     * Save Qustion to database
     * 
     * @param 
     * @return Question
     */
    public function createQuestion(Question $questionData)
    {
        throw new Exception('Not implemented');
    }
    
    /** 
     * Query database for matching questions
     * 
     * @param long game_id
     * @param long question_id
     * @return Question
     */
    public function getAnswer($gameId, $questionId)
    {
        throw new Exception('Not implemented');
    }
    
    /** 
     * Query database for matching game
     * 
     * @param long game_id
     * @return Game
     */
    public function getGame($gameId)
    {
        throw new Exception('Not implemented');
    }

    /** 
     * Generate and set unique user friendly code
     * 
     * TODO: Consider third party extension
     * 
     * @param Game game
     * @return void
     */
    public function setCode(Game $game)
    {
        $generatedCode = strtoupper(substr(uniqid(), -6));
        while(Game::where('code', $generatedCode)->first() != null)
        {
            $generatedCode = strtoupper(substr(uniqid(), -6));
        }

        $game->code = $generatedCode;
        $game->save();
    }
}