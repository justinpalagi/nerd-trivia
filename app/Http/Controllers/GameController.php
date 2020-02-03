<?php

namespace App\Http\Controllers;

use App\BusinessLogic\GameBL;
use Illuminate\Http\Request;
use App\Repositories\Contracts\IGameRepository;

class GameController extends Controller
{
    /**
     *
     * @param  IGameRepository  $repo
     * @return void
     */
    public function __construct(IGameRepository $repo)
    {
        $this->gameRepository = $repo;
    }
    
    /**
     * Create a new Game
     *
     * @param  Request  $request
     * @return Response
     */
    public function new(Request $request)
    {
        $ip = $request->ip();

        $game = $this->getGameBL()->createGame($ip);
        if($game == null)
            return response()->json(['error' => 'An error occurred creating the game.'], 500);

        return $game->code;
    }

    /**
     * Gets/Sets Lazy Property $gameBL
     *
     * @return GameBL
     */
    public function getGameBL()
    {
        if($this->gameBL == null)
            $this->gameBL = new GameBL($this->gameRepository);

        return $this->gameBL;
    }

    /**
     * Lazy Loaded Game Business Logic
     * 
     * @var GameBL
     */
    private $gameBL;

    /**
     * Data access layer games entity
     * 
     * @var IGameRepository
     */
    protected $gameRepository;
}
