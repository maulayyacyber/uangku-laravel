<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debit extends Model
{
    /**
     * @var string
     */
    protected $table = 'debit';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'nominal', 'description', 'debit_date'
    ];
}
