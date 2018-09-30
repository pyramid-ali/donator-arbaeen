<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Snapshot extends Model
{
    protected $fillable = [
        'data'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getDataAttribute($value)
    {
        return collect(json_decode($value, true));
    }
}
