<?php

namespace App\Repositories\Contracts;

interface IParticipantRepository
{
    public function createAnswer($answer_data);
    public function createParticipant($participant_data);
}