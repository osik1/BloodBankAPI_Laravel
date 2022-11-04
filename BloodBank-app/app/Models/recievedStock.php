<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recievedStock extends Model
{
    use HasFactory; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    /**
     * Get the blood request id in the recieved stock.
     */
    public function bloodRequest()
    {
        return $this->belongsTo('App\Models\bloodRequest');
        'bloodRequest_id';
    }

    /**
     * Get the blood type in the recieved stock.
     */
    public function bloodType()
    {
        return $this->belongsTo('App\Models\bloodType');
        'bloodType_id';
    }

    /**
     * Get the user who recieved the stock.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
        'user_id';
    }

    /**
     * Get the quantity of the recieved stock.
     */
    public function quantity()
    {
        return $this->belongsTo('App\Models\quantity');
        'quantity';
    }

    /**
     * Status should be 0.
     */ 
    public function received()
     {
         return $this->status == 0;
         'status';
     }
}
