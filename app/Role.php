<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany('\Corp\User','role_user');
    }
    public function permissions(){
        return $this->belongsToMany('\Corp\Permission','permission_role');
    }
    public function hasPermission($name, $require = FALSE){
        if(is_array($name)){
            foreach ($name as $permissionName) {
                $hasPermission = $this->hasPermission($permissionName);
                if($hasPermission && !$require){
                    return TRUE;
                }
                else if(!$hasPermission && $require){
                    return FALSE;
                }
            }
            return $require;
        }
        else{
            foreach ($this->permissions()->get() as $permission) {
                if ($permission->name == $name){
                        return TRUE;
                }
            }
        }
    }
    public function savePermissions($inputPermissions){
        if(!empty($inputPermissions)){
            $this->permissions()->sync($inputPermissions);
        }
        else{
            $this->permissions()->detach();
        }
        return TRUE;
    }
}
