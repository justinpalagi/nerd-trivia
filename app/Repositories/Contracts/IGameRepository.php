<?php

namespace App\Repositories\Contracts;

interface IGameRepository
{
    public function createGame($ip);
    public function createQuestion($question_factory);
    public function getAnswer($game_id, $question_id);
    public function getGame($game_id);
}