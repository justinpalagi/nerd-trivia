<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $participant_id
 * @property integer $game_id
 * @property string $name
 * @property Game $game
 * @property ParticipantAnswer[] $participantAnswers
 */
class Participant extends Model
{
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
        return $this->belongsTo('App\Game', null, 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participantAnswers()
    {
        return $this->hasMany('App\ParticipantAnswer', null, 'participant_id');
    }
}
