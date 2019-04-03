<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Repositories\PermissionsRepository;
use Corp\Repositories\RolesRepository;
use Illuminate\Http\Request;

class PermissionsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $per_rep;
    protected $role_rep;
    protected $user;
    protected $template;
    protected $content = FALSE;
    protected $title;
    protected $vars;

    public function index(PermissionsRepository $per_rep, RolesRepository $role_rep)
    {
        if(\Gate::denies('EDIT_USERS')){
            abort(403);
        }
        $this->per_rep = $per_rep;
        $this->role_rep = $role_rep;
        $this->template = env('THEME').'.admin.permissions';
        $this->title = 'Manager of permissions';
        $roles = $this->getRoles();
        $permissions = $this->getPermissions();
        $this->content = view(env('THEME').'.admin.permissions_content')->with(['roles'=>$roles, 'priv'=>$permissions])->render();
       return $this->renderOutput();
    }
    public function getRoles(){
        $roles = $this->role_rep->get();
        return$roles;
    }

    public function getPermissions(){
        $permissions = $this->per_rep->get();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PermissionsRepository $per_rep)
    {
        $this->per_rep = $per_rep;
        $this->template = env('THEME').'.admin.permissions';
        $this->title = 'Manager of permissions';
        $result = $this->per_rep->changePermissions($request);
            if(is_array($result) && !empty($result['error'])){
                return back()->with($result);
    }
    return back()->with($result);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
