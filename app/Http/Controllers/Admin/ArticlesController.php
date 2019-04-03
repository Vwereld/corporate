<?php

namespace Corp\Http\Controllers\Admin;

use Corp\Article;
use Corp\Category;
use Corp\Http\Requests\ArticleRequest;
use Corp\Repositories\ArticlesRepository;
use Auth;


class ArticlesController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticlesRepository $a_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('VIEW_ADMIN_ARTICLES')){
            abort(403);
        }
        $this->a_rep = $a_rep;
        $this->template = env('THEME').'.admin.articles';
        $this->title = 'Articles';
        $articles = $this->getArticles();
        $this->content = view(env('THEME').'.admin.articles_content')->with('articles', $articles)->render();
        return $this->renderOutput();
    }
    public function getArticles(){
        return $this->a_rep->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ArticlesRepository $a_rep)
    {
       if(\Gate::denies('save', new Article())){
           abort('403');
       }
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        $this->a_rep = $a_rep;
        $this->template = env('THEME').'.admin.articles';
       $this->title = 'Add new content';
       $categories = Category::select(['title','alias','parent_id','id'])->get();
       $lists = [];
       foreach($categories as $category){
           if($category->parent_id == 0){
               $lists[$category->title] = [];
           }
           else{
               $lists[$categories->where('id',$category->parent_id)->first()->title][$category->id] = $category->title;
           }
       }
        $this->content = view(env('THEME').'.admin.articles_content_create')->with('categories',$lists)->render();

       return $this->renderOutput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, ArticlesRepository $a_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        $this->title = 'Save Articles';
        $this->a_rep = $a_rep;
        $result = $this->a_rep->addArticle($request);
        if(is_array($result)&& !empty($result['error'])){
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
    public function edit(Article $article, ArticlesRepository $a_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        if(\Gate::denies('edit', new Article)){
            abort(403);
        }
        $this->a_rep = $a_rep;
        $this->template = env('THEME').'.admin.articles';
        $this->title = 'Editing of article';
        $article->img = json_decode($article->img);

        $categories = Category::select(['title','alias','parent_id','id'])->get();
        $lists = [];
        foreach($categories as $category){
            if($category->parent_id == 0){
                $lists[$category->title] = [];
            }
            else{
                $lists[$categories->where('id',$category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }
        $this->title = 'Editing of content - '.$article->title;
        $this->content = view(env('THEME').'.admin.articles_content_create')->with(['categories'=>$lists, 'article'=> $article])->render();
        return $this->renderOutput();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article, ArticlesRepository $a_rep)
    {
        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        $this->a_rep = $a_rep;
        $this->title = 'Editing of article';
        $result = $this->a_rep->updateArticle($request,$article);
        if(is_array($result)&& !empty($result['error'])){
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
    public function destroy(Article $article, ArticlesRepository $a_rep)
    {


        $this->user = \Auth::user();
        if(!$this->user){
            abort(403);
        }
        $this->a_rep = $a_rep;
        $result = $this->a_rep->deleteArticle($article);
        if(is_array($result)&& !empty($result['error'])){
            return back()->with($result);
        }
        return redirect('/admin')->with($result);
    }
}
