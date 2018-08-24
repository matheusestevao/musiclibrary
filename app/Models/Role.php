<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    public function permissions()
    {

    	return $this->belongsToMany(Permission::class);

    }
}
