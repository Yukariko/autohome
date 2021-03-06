<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    //
    protected $table = 'signals';
    protected $fillable = ['name', 'description'];

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

}
