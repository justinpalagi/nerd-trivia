<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $game_id
 * @property string $ip
 * @property string $create_at
 * @property string $code
 * @property Participant[] $participants
 * @property Question[] $questions
 */
class Game extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'game_id';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['ip', 'create_at', 'code'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants()
    {
        return $this->hasMany('App\Participant', 'game_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question', 'game_id');
    }

    public $timestamps = false;
}
