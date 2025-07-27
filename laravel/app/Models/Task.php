<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'priority',
        'status',
        'due_date',
        'access_token',
        'token_expiry',
        'token_expires_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'token_expiry' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(TaskHistory::class);
    }

    public function generatePublicToken()
    {
        $this->public_token = Str::random(32);
        $this->token_expires_at = now()->addDays(3);
        $this->save();
    }


}
