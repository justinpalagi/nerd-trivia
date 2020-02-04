<?php

namespace App\Repositories;

use App\Participant;
use App\Repositories\Contracts\IParticipantRepository;

class ParticipantRepository extends BaseEloquentRepository implements IParticipantRepository
{
    /**
     * Saves Answer to database
     * 
     * @param  
     * @return Answer
     */
    public function createAnswer($questionId, $answer){}

    /** 
     * Saves Participant to database
     * 
     * @param  
     * @return Participant
     */
    public function createParticipant($gameId, $participantName)
    {
        $newParticipant = new Participant;

        $newParticipant->name = $participantName;
        $newParticipant->game_id = $gameId;
        
        $newParticipant->save();

        return $newParticipant;
    }
}