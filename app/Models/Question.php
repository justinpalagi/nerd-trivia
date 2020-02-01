<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $question_id
 * @property integer $game_id
 * @property string $question
 * @property string $answer
 * @property int $category
 * @property string $start_time
 * @property Game $game
 * @property ParticipantAnswer[] $participantAnswers
 */
class Question extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'question_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['game_id', 'question', 'answer', 'category', 'start_time'];

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
        return $this->hasMany('App\ParticipantAnswer', null, 'question_id');
    }
}
