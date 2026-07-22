<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'image', 'customer_name', 'customer_name_cn', 'review_text', 'review_text_cn', 'rating', 'sort_level', 'status'
    ];
}
