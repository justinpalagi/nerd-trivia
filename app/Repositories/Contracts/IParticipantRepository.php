<?php

namespace App\Repositories\Contracts;

interface IParticipantRepository
{
    /**
     * Saves Answer to database
     * 
     * @param  
     * @return Answer
     */
    public function createAnswer($answerData);

    /** 
     * Saves Participant to database
     * 
     * @param  
     * @return Participant
     */
    public function createParticipant($gameId, $participantName);
}