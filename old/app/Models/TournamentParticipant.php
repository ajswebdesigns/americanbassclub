<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tournament;
use App\Models\User;

class TournamentParticipant extends Model
{
    use HasFactory;


    public function tournament()
    {
        return $this->hasOne(Tournament::class, 'id', 'tournament_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function partner()
    {
        return $this->hasOne(User::class, 'id', 'partner_id');
    }
}
