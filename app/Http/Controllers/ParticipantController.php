<?php

namespace App\Http\Controllers;

use App\BusinessLogic\ParticipantBl;
use App\Repositories\Contracts\IGameRepository;
use App\Repositories\Contracts\IParticipantRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParticipantController extends Controller
{
    /**
     *
     * @param  IParticipantRepository  $repo
     * @return void
     */
    public function __construct(IParticipantRepository $partRepo, IGameRepository $gameRepo)
    {
        $this->participantRepository = $partRepo;
        $this->gameRepository = $gameRepo;
    }

    /**
     * Create Participant and token
     *
     * @param string $gameCode
     */
    public function joinGame(Request $request, $gameCode)
    {
        //TODO: Data validation
        //TODO: Should check that game hasn't started or expired
        $game = $this->gameRepository->getGameByCode($gameCode);
        if($game == null)
            return response()->json(['error' => 'Could not find the game.'], 404);

        $data = $request->json()->all();
        $newParticipant = $this->getParticipantBL()->joinGame($game->game_id, $data['name']);

        $tokenResult = $newParticipant->createToken('gameAuthToken');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Score and Save Answer
     *
     * @param int $questionId
     */
    public function postAnswer(Request $request, $questionId)
    {
        //TODO: Data validation
        //TODO: Should check that game hasn't started or expired
        $game = $this->gameRepository->getGameById($request->user()->game_id);
        if($game == null)
            return response()->json(['error' => 'Could not find the game.'], 404);

        $question = $game->questions->firstWhere('question_id', $questionId);
        if($game == null)
            return response()->json(['error' => 'Could not find the question.'], 404);

        $participantAnswer = $question->participantAnswers->firstWhere('participant_id', $request->user()->participant_id);
        if($participantAnswer != null)
            return response()->json(['error' => 'You have already answered this question.'], 403);

        $data = $request->json()->all();
        $this->getParticipantBL()->saveAnswer($game->game_id, $question, $request->user(), $data['answer']);

        //TODO: consider returning actual answer
        return;
    }

    /**
     * Gets/Sets Lazy Property $participantBL
     *
     * @return ParticipantBL
     */
    private function getParticipantBL()
    {
        if($this->participantBL == null)
            $this->participantBL = new ParticipantBl($this->participantRepository);

        return $this->participantBL;
    }

    /**
     * Lazy Loaded Game Business Logic
     * 
     * @var ParticipantBL
     */
    private $participantBL;

    /**
     * 
     * @var IParticipantRepository
     */
    protected $participantRepository;

    /**
     * 
     * @var IGameRepository
     */
    protected $gameRepository;
}
