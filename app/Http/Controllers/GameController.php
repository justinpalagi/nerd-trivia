<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\IGameRepository;

class GameController extends Controller
{
    protected $repo;
    
    /**
     * Create a new Game
     *
     * @param  Request  $request
     * @return Response
     */
    public function new(Request $request)
    {
        $ip = $request->ip();

        $game = $this->repo->createGame($ip);

        //This isn't working. Model Extension?
        return $game->json();
    }

    /**
     *
     * @param  IGameRepository  $repo
     * @return void
     */
    public function __construct(IGameRepository $repo)
    {
        $this->repo = $repo;
    }
}
