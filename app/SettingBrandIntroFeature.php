<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingBrandIntroFeature extends Model
{
    protected $table = 'setting_brand_intro_features';

    protected $fillable = [
        'icon', 'title', 'subtitle', 'sort_level', 'status'
    ];
}
