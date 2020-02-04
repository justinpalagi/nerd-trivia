<?php

namespace App\Repositories\Contracts;

interface IParticipantRepository extends IBaseRepository
{
    /**
     * Saves Answer to database
     * 
     * @param int $gameId
     * @param int $questionId
     * @param int $participantId
     * @param string $answer
     * @return Answer
     */
    public function createAnswer($gameId, $questionId, $participantId, $answer);

    /** 
     * Saves Participant to database
     * 
     * @param int $gameId
     * @param string $participantName
     * @return Participant
     */
    public function createParticipant($gameId, $participantName);

    /** 
     * Add the score to the Participants total score
     * 
     * @param Participant $participant
     * @param int $score
     * @return Participant
     */
    public function updateParticipantScore($participant, $score);
}