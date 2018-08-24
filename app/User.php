<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RoleUser;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ReturnRoleUser ($idUser)
    {

        $roleId = RoleUser::find($idUser);

        return $roleId->id;

    }

    public function ReturnNameRole($idUser)
    {

        $idRole = RoleUser::where('user_id',$idUser)->first();

        return Role::find($idRole->role_id)->label;

    }
    
    public function roles ()
    {

        return $this->belongsToMany(Role::class);

    }

    public function hasPermission (Permission $permission)
    {

        return $this->hasAnyRoles($permission->roles);

    }

    public function hasAnyRoles ($roles)
    {

        if (is_array($roles) || is_object($roles)) {
            return !! $roles->intersect($this->roles)->count();
        }

        return $this->roles->contains('name', $roles);

    }

    public $rulesStore = [
        
        'name'                  => 'required',
        'email'                 => 'required|email',
        'password'              => 'required|min:4|confirmed',
        'password_confirmation' => 'required|min:4',
        'image'                 => 'required|image',

        
    ];

    public $rulesUpdate = [
        
        'name'             => 'required',
        'email'            => 'required|email',
        
    ];

}
