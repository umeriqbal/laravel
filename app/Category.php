<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function nice_actions()
    {
        return $this->belongsToMany('app\NiceAction', 'categories_nice_actions');
    }
}
