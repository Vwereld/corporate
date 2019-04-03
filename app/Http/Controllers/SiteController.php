<?php

namespace Corp\Http\Controllers;

use Corp\Repositories\MenusRepository;



class SiteController extends Controller
{
   protected $p_rep;
//   свойство для хранения обьекта класса портфолио_репозиторий/ будет использоваться для храннеия логики
//   по работе с портфолио
    protected $s_rep;
//    slider repository
    protected $a_rep;
//    articles_repo
    protected $m_rep;
    protected $us_rep;
    protected $rol_rep;
    protected $user;

    protected $keywords;
    protected $meta_desc;
    protected $title;
//    menus
    protected $template;
//    имя шаблона для отображения информации на конкретной странице
    protected $vars = [];
    protected $contentRightBar = FALSE;
//    инфо отображающееся в правом сайдбаре
    protected $contentLeftBar = FALSE;
    protected $bar = 'no';
//    sidebar
public function __construct(MenusRepository $m_rep)
{
    $this->m_rep = $m_rep;
}

protected function renderOutput(){
    $menu = $this->getMenu();

    $navigation = view(env('THEME').'.navigation')->with('menu', $menu)->render();
    $this->vars = array_add($this->vars, 'navigation', $navigation);

    if($this->contentRightBar){
        $rightBar = view(env('THEME').'.rightBar')->with('content_rightBar', $this->contentRightBar)->render();
        $this->vars = array_add($this->vars, 'rightBar', $rightBar);
    }
    if($this->contentLeftBar){
        $leftBar = view(env('THEME').'.leftBar')->with('content_leftBar', $this->contentLeftBar)->render();
        $this->vars = array_add($this->vars, 'leftBar', $leftBar);
    }
    $this->vars = array_add($this->vars, 'bar', $this->bar);
    $this->vars = array_add($this->vars, 'keywords', $this->keywords);
    $this->vars = array_add($this->vars, 'meta_desc', $this->meta_desc);
    $this->vars = array_add($this->vars, 'title', $this->title);
    $footer = view(env('THEME').'.footer')->render();
    $this->vars = array_add($this->vars, 'footer', $footer);
    return view($this->template)->with($this->vars);
}
public function getMenu() {

    $menu = $this->m_rep->get();
    $mBuilder = \Menu::make('MyNav', function ($m) use ($menu){
//М - не что иное как переменная м_билдер которая формируется вначале
        foreach ($menu as $item) {
            if($item->parent == 0){
        $m->add($item->title, $item->path)->id($item->id);
//метод адд дбавляет  обьект мбилдер новый пункт меню
            }
            else{
                if($m->find($item->parent)){
                    $m->find($item->parent)->add($item->title, $item->path)->id($item->id);
                }
            }
        }
    });
    return $mBuilder;
}
}
