<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bloodType extends Model
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
    
    ];


    /**
     * One to Many relation
     */

    // public function bloodType()
    // {
    //     return $this->hasMany(BloodType::class);
    // }

    /**
     * has many relation
     */
    public function bloodRequest()
    {
        return $this->hasMany(bloodRequest::class);
    }

    /**
     * has many relation
     */
    public function openBloodRequest()
    {
        return $this->hasMany(openBloodRequest::class);
    }

    
}