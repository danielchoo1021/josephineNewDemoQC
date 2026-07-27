<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingOverrideHierarchyCommission extends Model
{
    protected $fillable = [
        'agent_lvl', 'comm_amount', 'status'
    ];
}
