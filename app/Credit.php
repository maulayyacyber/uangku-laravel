<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    /**
     * @var string
     */
    protected $table = 'credit';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'nominal', 'description', 'credit_date'
    ];
}
