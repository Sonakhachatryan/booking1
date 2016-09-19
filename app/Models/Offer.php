<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers';

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
    protected $fillable = ['title', 'content','offerable_id','offerable_type'];

    public function offerable()
    {
        return $this->morphTo();
    }
}
