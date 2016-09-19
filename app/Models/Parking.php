<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'parkings';

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
    protected $fillable = ['duration','price','available','count','parkingable_id','parkingable_type'];

    public function parkingable()
    {
        return $this->morphTo();
    }
}
