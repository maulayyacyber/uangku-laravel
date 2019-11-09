<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesCredit extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories_credit';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'name'
    ];
}
