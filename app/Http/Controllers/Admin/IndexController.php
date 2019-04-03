<?php

namespace Corp\Http\Controllers\Admin;


class IndexController extends AdminController
    public function index(){

        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('VIEW_ADMIN')){
            abort(403);
        }
        $this->template = env('THEME').'.admin.index';
        $this->title = 'Admin dashboard';
        return $this->renderOutput();
    }
}
