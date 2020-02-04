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
     * @param string $ip
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
     * @param Question $questionData
     * @return Question
     */
    public function createQuestion(Question $questionData)
    {
        $questionData->start_time = Carbon::now('UTC');
        $questionData->save();

        return $questionData;
    }
    
    /** 
     * Query database for matching questions
     * 
     * @param int game_id
     * @param int question_id
     * @return Question
     */
    public function getAnswer($gameId, $questionId)
    {
        throw new Exception('Not implemented');
    }
    
    /** 
     * Query database for matching game
     * 
     * @param int game_id
     * @return Game
     */
    public function getGameByCode($gameCode)
    {
        return Game::where('code', $gameCode)->first();
    }

    /** 
     * Query database for matching game
     * 
     * @param int $gameId
     * @return Game
     */
    public function getGameById($gameId)
    {
        return Game::where('game_id', $gameId)->first();
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