<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesDebit extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories_debit';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'name'
    ];
}
