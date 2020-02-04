<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * @property integer $participant_id
 * @property integer $game_id
 * @property string $name
 * @property Game $game
 * @property ParticipantAnswer[] $participantAnswers
 */
class Participant extends Authenticatable
{
    use HasApiTokens;

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'participant_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['game_id', 'name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game()
    {
        return $this->belongsTo('App\Game', 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantAnswers()
    {
        return $this->hasMany('App\Answer', 'participant_id');
    }

    public $timestamps = false;
}
