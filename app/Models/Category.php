<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereId(int $id)
 * @method static create(array $fields)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];

    public function lots()
    {
        return $this->belongsToMany( Lot::class, 'lot_categories' );
    }
}
