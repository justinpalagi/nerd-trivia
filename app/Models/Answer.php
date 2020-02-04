<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $answer_id
 * @property integer $question_id
 * @property integer $participant_id
 * @property string $answer
 * @property string $time_submitted
 * @property Participant $participant
 * @property Question $question
 */
class Answer extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'participant_answers';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'answer_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['question_id', 'participant_id', 'answer', 'time_submitted'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function participant()
    {
        return $this->belongsTo('App\Participant', 'participant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public $timestamps = false;
}
