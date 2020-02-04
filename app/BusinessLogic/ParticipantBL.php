<?php

namespace App\BusinessLogic;

use App\Repositories\Contracts\IParticipantRepository;


class ParticipantBl
{
    /**
     *
     * @param  IParticipantRepository  $repo
     * @return void
     */
    public function __construct(IParticipantRepository $repo)
    {
        $this->partRepository = $repo;
    }

    /**
     * Full transaction of creating a new game
     * 
     * @param  string  $ip
     * @return Game
     */
    public function joinGame($gameId, $participantName)
    {
        try 
        {
            $this->partRepository->startStorageTransaction();

            $newParticipant = $this->partRepository->createParticipant($gameId, $participantName);
    
            $this->partRepository->endStorageTransaction();
        } 
        catch (\PDOException $e) 
        {
            //Log exception

            $this->partRepository->handleTransactionError();
        }

        return $newParticipant;
    }

    /**
     * Data Access layer for games entity
     * 
     * @var IParticipantRepository
     */
    protected $partRepository;
}