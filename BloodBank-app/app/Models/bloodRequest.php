<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bloodRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'facility_id',
        'blood_type_id',
        'quantity',
    ];


    

    /**
     * Get the user that sends the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function user()
    {
        return $this->belongsTo(User::class);
        'user_id';
    }
    

    /**
     * Get the bloodType for the Request
     */
    public function bloodType()
    {
        return $this->belongsTo(bloodType::class);
        'blood_type_id';
    }

    /**
     * Get the facility that will receive the Request
     */
    public function facility()
    {
        return $this->belongsTo(Facility::class);
        'facility_id';
    }

    /**
     * Get a reference code for the Request
     */
    public function getRefCodeAttribute()
    {
        return 'R' . $this->id;
        'ref_code';
        
    }

    /**
     * Make status of the request as 0 (pending)
     */
    public function pending()
    {
        $this->status = 0;
        'status';
        $this->save();
    }

   

    
}




