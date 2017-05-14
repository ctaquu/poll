<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PossibleAnswer extends Model
{
    /**
     * Get the question that owns the possible answer.
     */
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
