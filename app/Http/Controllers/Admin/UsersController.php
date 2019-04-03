<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Http\Requests\UserRequest;
use Corp\Repositories\RolesRepository;
use Corp\Repositories\UsersRepository;
use Corp\Role;
use Corp\User;
use Auth;

class UsersController extends AdminController
{
    protected $us_rep;
    protected $rol_rep;
    protected $title;
    protected $template;
    protected $content = FALSE;
    protected $vars;
    protected $user;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(UsersRepository $us_rep, RolesRepository $rol_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('EDIT_USERS')){
            abort(403);
        }
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
        $this->title = 'Users';
        $this->template = env('THEME').'.admin.users';
        $users = $this->us_rep->get();
        $this->content = view(env('THEME').'.admin.users_content')->with(['users'=>$users])->render();
        return $this->renderOutput();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(UsersRepository $us_rep, RolesRepository $rol_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('EDIT_USERS')){
            abort(403);
        }
        $this->template = env('THEME').'.admin.users';
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
        $this->title = 'New user';
        $roles = $this->getRoles()->reduce(function ($returnRoles, $role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        },[]);
        $this->content = view(env('THEME').'.admin.users_create_content')->with(['roles'=>$roles])->render();
        return $this->renderOutput();
    }
    public function getRoles(){
        return Role::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UsersRepository $us_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('EDIT_USERS')){
            abort(403);
        }
        $this->us_rep = $us_rep;
        $result = $this->us_rep->addUser($request);
        if(is_array($result) && !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, UsersRepository $us_rep, RolesRepository $rol_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('EDIT_USERS')){
            abort(403);
        }
        $this->template = env('THEME').'.admin.users';
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
        $this->title = 'Editing of user -' .$user->name;
        $roles = $this->getRoles()->reduce(function ($returnRoles, $role){
            $returnRoles[$role->id] = $role->name;
            return $returnRoles;
        },[]);
        $this->content = view(env('THEME').'.admin.users_create_content')->with(['roles'=>$roles,'user'=>$user])->render();
        return $this->renderOutput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user, UsersRepository $us_rep, RolesRepository $rol_rep)
    {
        $this->us_rep = $us_rep;
        $this->rol_rep = $rol_rep;
       $result = $this->us_rep->updateUser($request,$user);
       if(is_array($result) && !empty($result['error'])){
           return back()->with($result);
       }
       return redirect('/admin')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, UsersRepository $us_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        $this->template = env('THEME').'.admin.users';
        $this->us_rep = $us_rep;
        $result = $this->us_rep->deleteUser($user);
        if(is_array($result) && !empty($result['error'])){
    return back()->with($result);
    }
    return redirect('/admin')->with($result);
    }
}
