<?php

namespace App\BusinessLogic;

use App\Factories\QuestionFactoryGenerator;
use App\Repositories\Contracts\IGameRepository;

class GameBL
{
    /**
     *
     * @param  IGameRepository  $repo
     * @return void
     */
    public function __construct(IGameRepository $repo)
    {
        $this->gameRepository = $repo;
        $this->categories = collect(["got", "periodic"]);
    }

    /**
     * Full transaction of creating a new game
     * 
     * @param  string  $ip
     * @return Game
     */
    public function createGame($ip)
    {
        try 
        {
            $this->gameRepository->startStorageTransaction();

            $newGame = $this->gameRepository->createGame($ip);
    
            $this->gameRepository->setCode($newGame);
    
            $this->gameRepository->endStorageTransaction();
        } 
        catch (\PDOException $e) 
        {
            //Log exception

            $this->gameRepository->handleTransactionError();
        }

        return $newGame;
    }

    /**
     * Full transaction of creating a new game
     * 
     * @param  Game $game
     * @return Question
     */
    public function getNextQuestion($game)
    {
        $category = $this->getNextOrCurrentCategory($game);        
        if($category == null) return null;

        $factory = QuestionFactoryGenerator::run($category);       

        do
        {
            $questionData = $factory->getQuestion();
        } 
        while($game->questions->contains('question', $questionData->question));
        
        $questionData->game_id = $game->game_id;

        try 
        {
            $this->gameRepository->startStorageTransaction();

            $newQuestion = $this->gameRepository->createQuestion($questionData);
    
            $this->gameRepository->endStorageTransaction();

            return $newQuestion;
        } 
        catch (\PDOException $e) 
        {
            //Log exception
            //error_log($e);
            $this->gameRepository->handleTransactionError();
        }

        return null;
    }

    /**
     * Based on the current state of the game gets the next or current category
     * 
     * @param Game $game
     * @return string
     */
    private function getNextOrCurrentCategory($game)
    {
        $size = sizeof($game->questions);

        if($size == (self::ROUNDS * self::QUESTIONSINROUND))
            return null;
        
        if($size % self::QUESTIONSINROUND == 0)
        {   
            $randomCategories = $this->categories->random($this->categories->count());

            foreach ($randomCategories as &$category) {
                if(!$game->questions->contains('category', $category))
                {
                    return $category;
                }
            }
        }

        $grouped = $game->questions->groupBy('category');

        $currentGroup = $grouped->first(function ($value, $key) {
            return $value->count() < self::QUESTIONSINROUND;
        });

        return $currentGroup[0]->category;
    }

    /**
     * Data Access layer for games entity
     * 
     * @var IGameRepository
     */
    protected $gameRepository;

    /**
     * This should be stored in db or a global file
     * 
     * @var array
     */
    protected $categories; //Excludes marvel because not implemented at the moment

    /**
     * These should be db or global configs
     */
    const ROUNDS = 2;
    const QUESTIONSINROUND = 3;
}