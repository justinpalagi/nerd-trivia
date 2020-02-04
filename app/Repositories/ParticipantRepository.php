<?php

namespace App\Repositories;

use App\Answer;
use App\Participant;
use App\Repositories\Contracts\IParticipantRepository;
use Carbon\Carbon;

class ParticipantRepository extends BaseEloquentRepository implements IParticipantRepository
{
    /**
     * Saves Answer to database
     * 
     * @param int $gameId
     * @param int $questionId
     * @param int $participantId
     * @param string $answer
     * @return void
     */
    public function createAnswer($gameId, $questionId, $participantId, $answer)
    {
        $newAnswer = new Answer;

        $newAnswer->answer = $answer;
        $newAnswer->participant_id = $participantId;
        $newAnswer->question_id = $questionId;
        $newAnswer->time_submitted = Carbon::now('UTC');

        $newAnswer->save();
    }

    /** 
     * Saves Participant to database
     * 
     * @param int $gameId
     * @param string $participantName
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

    /** 
     * Add the score to the Participants total score
     * 
     * @param Participant $participant
     * @param int $score
     * @return Participant
     */
    public function updateParticipantScore($participant, $score)
    {
        $participant->score += $score;

        $participant->save();
    }
}