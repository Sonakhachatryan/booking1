<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantKitchen extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restaurant_kitchen';

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
    protected $fillable = ['kitchen_id', 'restaurant_id'];


}
