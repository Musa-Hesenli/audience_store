<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'description' ];

    public function categories()
    {
        return $this->belongsToMany( Category::class, 'lot_categories' );
    }
}
