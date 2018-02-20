<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $appends = ['imageURL'];

    public function attributes()
    {
        return $this->belongsToMany('App\Models\Attribute')->withPivot('value');
    }

    public function user()
    {
        return $this->BelongsTo('App\Models\User');
    }

    public function getImageURLAttribute()
    {
        //TODO: real url
        return 'http://via.placeholder.com/350?text=card+id'.$this->id;
    }
}
