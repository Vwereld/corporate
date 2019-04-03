<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 02/12/2018
 * Time: 18:23
 */
namespace Corp\Repositories;



use Corp\Role;

class RolesRepository extends Repository
{
    public function __construct(Role $role)
    {
        $this->model = $role;
    }

}


