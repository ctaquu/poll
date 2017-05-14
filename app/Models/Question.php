<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * Get the poll that owns the question.
     */
    public function poll()
    {
        return $this->belongsTo('App\Models\Poll');
    }

    /**
     * Get the possible answers record associated with the question.
     */
    public function possibleAnswers()
    {
        return $this->hasMany('App\Models\PossibleAnswer');
    }

}
