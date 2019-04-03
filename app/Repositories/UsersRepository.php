<?php
/**
 * Created by PhpStorm.
 * User: Vitaly
 * Date: 02/12/2018
 * Time: 18:23
 */
namespace Corp\Repositories;



use Corp\User;

class UsersRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function addUser($request){
        if(\Gate::denies('create',$this->model)){
            abort(403);
        }
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'login' => $data['login'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        if($user){
            $user->roles()->attach($data['role_id']);
        }
        return ['status'=>'User is added'];
    }
    public function updateUser($request, $user){
        if(\Gate::denies('create',$this->model)){
            abort(403);
        }
        $data = $request->all();
        if (isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }
        $user->fill($data)->update();
        $user->roles()->sync([$data['role_id']]);

        return ['status'=>'User is updated'];
        }
    public function deleteUser($user){
        if(\Gate::denies('create',$this->model)){
            abort(403);
        }
        $user->roles()->detach();
        if($user->delete()){
            return ['status' =>'User is deleted'];
        }
    }
}


