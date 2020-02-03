<?php

namespace App\BusinessLogic;

use App\Repositories\Contracts\IGameRepository;

class GameBL
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
     * Full transaction of creating a new game
     * 
     * @param  string  $ip
     * @return Game
     */
    public function CreateGame($ip)
    {
        try 
        {
            $this->gameRepository->startTransaction();

            $newGame = $this->gameRepository->createGame($ip);
    
            $this->gameRepository->setCode($newGame);
    
            $this->gameRepository->endTransaction();
        } 
        catch (\PDOException $e) 
        {
            //Log exception

            $this->gameRepository->rollBackTransaction();
        }

        return $newGame;
    }

    /**
     * Data Access layer for games entity
     * 
     * @var IGameRepository
     */
    protected $gameRepository;
}