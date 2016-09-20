<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'kitchens';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class,'restaurant_kitchen');
    }
}
