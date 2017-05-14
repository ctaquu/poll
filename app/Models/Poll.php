<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    /**
     * Get the question record associated with the poll.
     */
    public function question()
    {
        return $this->hasOne('App\Models\Question');
    }
}
