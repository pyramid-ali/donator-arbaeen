<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'tid',
        'first_name',
        'last_name',
        'username',
        'language_code',
        'is_bot'
    ];

    protected $with = [
        'stage'
    ];

    public function stage()
    {
        return $this->hasOne(Stage::class);
    }

    public function snapshots()
    {
        return $this->hasMany(Snapshot::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
