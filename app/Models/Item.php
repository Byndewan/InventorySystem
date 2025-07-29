<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    protected $guarded;
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function histories()
    {
        return $this->hasMany(ItemHistory::class)->latest();
    }
}
