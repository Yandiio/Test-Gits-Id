<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book';

    protected $fillable = [
        'book_name','date_release','author_id', 'descrpition','number_of_page', 'publisher_id'
    ];

}
