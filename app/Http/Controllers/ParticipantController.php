<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\IParticipantRepository;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    /**
     *
     * @param  IParticipantRepository  $repo
     * @return void
     */
    public function __construct(IParticipantRepository $repo)
    {
        $this->participantRepository = $repo;
    }

    /**
     * Test Auth
     *
     */
    public function question(Request $request)
    {
        $user = $request->user();

        //error_log($user->participant_id);

        return $user;
    }

    /**
     * Create Participant and token
     *
     */
    public function join(Request $request)
    {
        //Validate Data

        $newParticipant = $this->participantRepository->createParticipant($request->gameId, $request->name);

        $tokenResult = $newParticipant->createToken('gameAuthToken');
        $token = $tokenResult->token;
        $token->save();
        return response()->json([
            'participant_id' => $newParticipant->participant_id,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Data access layer games entity
     * 
     * @var IParticipantRepository
     */
    protected $participantRepository;
}
