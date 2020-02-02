<?php

namespace App\Repositories;

use Exception;
use App\Game;
use Carbon\Carbon;
use App\Repositories\Contracts\IGameRepository;

class GameRepository implements IGameRepository
{
    public function createGame($ip)
    {
        $newGame = new Game;

        $newGame->create_at = Carbon::now('UTC');
        $newGame->ip = $ip;

        $newGame->save();

        return $newGame;
    }

    public function createQuestion($question_factory)
    {
        throw new Exception('Not implemented');
    }
    
    public function getAnswer($game_id, $question_id)
    {
        throw new Exception('Not implemented');
    }
    
    public function getGame($game_id)
    {
        throw new Exception('Not implemented');
    }
}