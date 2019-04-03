<?php

namespace Corp\Http\Controllers;

use Corp\Menu;
use Corp\Repositories\MenusRepository;
use Illuminate\Http\Request;

class ContactsController extends SiteController
{
    public function __construct()
    {
        parent::__construct(new MenusRepository(new Menu()));

        $this->bar = 'left';
        $this->template = env('THEME').'.contacts';
    }

    public function index(Request $request){
        if($request->isMethod('post')){
            $messages = [
                'required' => 'Field :attribute is neccesary',
                'email' => 'Field :attribute is neccesary'
            ];
            $this->validate($request,[
                'name' => 'required|max:255',
                'emafooter.blade.phpil' => 'required|email',
                'text' => 'required'
            ]);
            $data = $request->all();
            $result = \Mail::send(env('THEME').'.email',['data' => $data], function($m) use($data) {
                $mail_admin = env('MAIL_ADMIN');
                $m->from($data['email'], $data['name']);
                $m->to($mail_admin, 'Mr_Admin')->subject('Question');
            });
            if($result){
                return redirect()->route('contacts')->with('status', 'Email is sent');
            }
        }
        $this->title = 'Contacts';
        $content = view(env('THEME').'.contact_content')->render();
        $this->vars = array_add($this->vars, 'content', $content);
        $this->contentLeftBar = view(env('THEME').'.contact_bar')->render();
        return $this->renderOutput();
    }
}
