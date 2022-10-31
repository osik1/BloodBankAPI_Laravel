<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'city',
        'region',
        'gps',
    ];

    /**
     * Get the User that owns the Facility
     */
    public function user()
    {
        return $this->belongsTo(User::class);
         'user_id';// this is the name of the user that owns the facility';
    }


    /**
     * One to Many relation
     */
    public function bloodRequest()
    {
        return $this->hasMany(bloodRequest::class);
    }
}
