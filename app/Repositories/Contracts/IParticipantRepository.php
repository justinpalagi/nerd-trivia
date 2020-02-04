<?php

namespace App\Repositories\Contracts;

interface IParticipantRepository extends IBaseRepository
{
    /**
     * Saves Answer to database
     * 
     * @param long $questionId
     * @param string $answer
     * @return Answer
     */
    public function createAnswer($questionId, $answer);

    /** 
     * Saves Participant to database
     * 
     * @param long $gameId
     * @param string $participantName
     * @return Participant
     */
    public function createParticipant($gameId, $participantName);
}