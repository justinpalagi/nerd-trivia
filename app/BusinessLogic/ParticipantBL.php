<?php

namespace App\BusinessLogic;

use App\Repositories\Contracts\IParticipantRepository;
use Carbon\Carbon;

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
     * Full transaction of scoring and saving participant answer
     * 
     * @param int $gameId
     * @param Question $questionId
     * @param int $participantId
     * @param string $answer
     * @return Void
     */
    public function saveAnswer($gameId, $question, $participant, $answer)
    {
        $score = $this->calculateScore($question, $answer);

        try 
        {
            $this->partRepository->startStorageTransaction();

            if($score > 0)
                $this->partRepository->updateParticipantScore($participant, $score);

            $this->partRepository->createAnswer($gameId, $question->question_id, $participant->participant_id, $answer);
    
            $this->partRepository->endStorageTransaction();
        } 
        catch (\PDOException $e) 
        {
            //Log exception

            $this->partRepository->handleTransactionError();
        }
    }

    /**
     * Calculate answer score based on how long it took to answer the question
     * 
     * @param Question $question
     * @param string $answer
     * @return int
     */
    private function calculateScore($question, $answer)
    {
        if($answer != $question->answer)
            return 0;

        $startTime = new Carbon($question->start_time);
        $endTime = Carbon::now();

        $difference = $startTime->diffInSeconds($endTime);

        error_log($difference);
        
        if($difference <= 10)
            return 6;
        if($difference <= 20)
            return 5;
        if($difference <= 30)
            return 4;
        if($difference <= 40)
            return 3;
        if($difference <= 50)
            return 2;
        if($difference <= 60)
            return 1;

        return 0;
    }

    /**
     * Data Access layer for games entity
     * 
     * @var IParticipantRepository
     */
    protected $partRepository;
}