<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'publisher';

    protected $fillable = ['publisher_name', 'phone_number', 'city', 'address', 'state', 'zip'];

    
    public function book()
    {
    	return $this->hasOne('App\Models\Book');
    }
}
