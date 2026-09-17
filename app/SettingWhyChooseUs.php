<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingWhyChooseUs extends Model
{
    protected $table = 'setting_why_choose_uses';

    protected $fillable = [
        'image', 'title', 'subtitle', 'sort_level', 'status'
    ];
}
