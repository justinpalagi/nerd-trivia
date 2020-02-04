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
    public function newGame(Request $request)
    {
        $ip = $request->ip();

        $game = $this->getGameBL()->createGame($ip);
        if($game == null)
            return response()->json(['error' => 'An error occurred creating the game.'], 500);

        return $game->code;
    }

    /**
     * Get the next question for the game
     *
     * @param  Request  $request
     * @return Response
     */
    public function nextQuestion(Request $request)
    {
        //TODO: Check if game is still active
        $game = $this->gameRepository->getGameById($request->user()->game_id);
        if($game == null)
            return response()->json(['error' => 'Could not find the game.'], 404);

        $question = $this->getGameBL()->getNextQuestion($game);
        if($question == null)
            return response()->json(['error' => 'There are no more questions for this game.'], 404);

        return $question->makeHidden('answer')->toJson();
    }

    /**
     * Gets/Sets Lazy Property $gameBL
     *
     * @return GameBL
     */
    private function getGameBL()
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
     * 
     * @var IGameRepository
     */
    protected $gameRepository;
}
