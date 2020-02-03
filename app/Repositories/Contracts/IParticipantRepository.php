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
    public function createAnswer($answer_data);

    /** 
     * Saves Participant to database
     * 
     * @param  
     * @return Participant
     */
    public function createParticipant($participant_data);
}