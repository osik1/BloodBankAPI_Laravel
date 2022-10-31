<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class openBloodRequest extends Model
{
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id'; 
    protected $fillable = [
        'blood_type_id',
        'user_id',
        'quantity',
        
    ];


    /**
     * Get the blood type in this request.
     */ 
    public function bloodType()
    {
        return $this->belongsTo('App\Models\bloodType');
    }

    /**
     * Get the user who made this request.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User'); 
    }


    /**
     * status should be 0
     */
    public function pending()
    {
        return $this->status == 0;
        'status';
    }

}
