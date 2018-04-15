<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Log extends Model
{
    protected $fillable = ['signal_id', 'value'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('id', 'desc');
        });
    }

    public function signal()
    {
        return $this->belongsTo('App\Signal');
    }

    public function scopeGetById($query, $id)
    {
        if($id == 0)
            return $query->get();
        return $query->where('signal_id', $id);
    }

}
