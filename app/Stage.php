<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Stage extends Model
{

    protected $fillable = [
        'name'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function setName($name)
    {
        $this->forceFill([
            'name' => $name
        ]);

        $this->save();
    }

    public function removeOption()
    {
        $this->forceFill([
            'options' => null
        ]);

        $this->save();
    }

    public function addOption(Collection $option)
    {
        $this->forceFill([
            'options' => $this->options->merge($option)->toJson()
        ]);

        $this->save();
    }

    public function setOptions(Collection $options)
    {
        $this->forceFill([
            'options' => $options->toJson()
        ]);

        $this->save();
    }

    public function getOptionsAttribute($value)
    {
        return collect(json_decode($value, true));
    }
}
