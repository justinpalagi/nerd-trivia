<?php

namespace App\Repositories;

use Exception;
use App\Game;
use App\Question;
use Carbon\Carbon;
use App\Repositories\Contracts\IGameRepository;

class GameRepository extends BaseEloquentRepository implements IGameRepository
{
    public function createGame($ip)
    {
        $newGame = new Game;

        $newGame->create_at = Carbon::now('UTC');
        $newGame->ip = $ip;

        $newGame->save();

        return $newGame;
    }

    public function createQuestion(Question $questionData)
    {
        throw new Exception('Not implemented');
    }
    
    public function getAnswer($gameId, $questionId)
    {
        throw new Exception('Not implemented');
    }
    
    public function getGame($gameId)
    {
        throw new Exception('Not implemented');
    }

    //TODO: Consider third party extension
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