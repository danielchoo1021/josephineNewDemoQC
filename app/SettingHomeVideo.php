<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingHomeVideo extends Model
{
    protected $fillable = [
        'image', 'title', 'title_cn', 'text', 'text_cn', 'description', 'description_cn', 'status'
    ];
}
