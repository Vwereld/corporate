

        <div id="content-page" class="content group">
<div class="hentry group">
    {!! Form::open(['url' => (isset($article->id)) ? route('update',['articles' => $article->alias]) : route('store'), 'class'=> 'contact-form', 'method' =>'POST','enctype' =>'multipart/form-data']) !!}
    @if(isset($article->id))
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @endif
    <ul>
        <li class="text-field">
            <label class="name-contact-us">
            <span class="label">Название:</span>
            <br/>
            <span class="sublabel">Заголовок материала</span><br/>
        </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!!  Form::text('title',isset($article->title)? $article->title : old('title'),['placeholder' =>'Enter your title'])!!}</div>
        </li>
        <li class="text-field">
            <label class="name-contact-us">
                <span class="label">Ключевые слова:</span>
                <br/>
                <span class="sublabel">Заголовок материала</span><br/>
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('keywords',isset($article->keywords)? $article->keywords : old('keywords'),['placeholder' =>'Enter your keywords'])!!}</div>
        </li>
        <li class="text-field">
            <label class="name-contact-us">
                <span class="label">Мета описание:</span>
                <br/>
                <span class="sublabel">Заголовок материала</span><br/>
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('meta_desc',isset($article->meta_desc)? $article->meta_desc : old('meta_desc'),['placeholder' =>'Enter your meta_desc'])!!}</div>
        </li>
        <li class="text-field">
            <label class="name-contact-us">
                <span class="label">Псевдоним:</span>
                <br/>
                <span class="sublabel">Введите псевдоним</span><br/>
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('alias',isset($article->alias)? $article->alias : old('alias'),['placeholder' =>'Enter alias'])!!}</div>
        </li>
        <li class="textarea-field">
            <label class="name-contact-us">
                <span class="label">Краткое описание:</span>
                <br/>
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::textarea('desc',isset($article->desc)? $article->desc : old('desc'),['placeholder' =>'Enter description','id'=>'editor2'])!!}</div>
        </li>
        <li class="textarea-field">
            <label class="name-contact-us">
                <span class="label">Описание:</span>
                <br/>
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::textarea('text',isset($article->text)? $article->text : old('text'),['placeholder' =>'Enter your text', 'id'=>'editor'])!!}</div>
            <div class="msg-error"></div>
        </li>


        @if(isset($article->img->path))
            <li class="textarea-field">
                <label>
                    <span class="label">Image:</span>
                </label>
                    {{ Html::image(asset(env('THEME')).'/images/articles/'.$article->img->path) }}
                    {!! Form::hidden('old_image',$article->img->path) !!}
            </li>
        @endif
        <li class="text-field">
            <label class="name-contact-us">
                <span class="label"> Image:</span>
                <br/>
                <span class="sublabel">Image</span><br/>
            </label>
            <div class="input-prepend">
                {!! Form::file('image',['class'=>'filestyle', 'data-buttonText'=>'choose image','data-buttonName'=>'image'])!!}
            </div>
        </li>
        <li class="text-field">
            <label class="name-contact-us">
                <span class="label"> Category:</span>
                <br/>
                <span class="sublabel">Category of material</span><br/>
            </label>
            <div class="input-prepend">
                {!! Form::select('category_id',$categories, isset($article->category_id) ? $article->category_id : '')!!}
            </div>
        </li>
        <li class="submit-button">
            {!! Form::button('Save',['class'=>'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
        </li>
    </ul>

    {!! Form::close() !!}

    <script>
        CKEDITOR.replace('editor');
        CKEDITOR.replace('editor2');
    </script>

</div>
 </div>



