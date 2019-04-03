
    @if($articles)
        <div id="content-page" class="content group">
<div class="hentry group">
    <h2>Added articles</h2>
    <div class="short-table white">
        <table style="width:100%" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th class="align-left">ID</th>
            <th>Tilte</th>
            <th>Text</th>
            <th>Image</th>
            <th>Category</th>
            <th>Alias</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td class="align-left">{{$article->id}}</td>
                <td class="align-left">{!!Html::link(route('edit',['articles'=>$article->alias]),$article->title) !!}</td>
                <td class="align-left">{{str_limit($article->text,200)}}</td>
                <td class="align-left">
                    @if(isset($article->img->mini))
                        {!! Html::image(asset(env('THEME')).'/images/articles/'.$article->img->mini) !!}
                @endif</td>
                <td class="align-left">{{$article->category->title}}</td>
                <td class="align-left">{{$article->alias}}</td>
                <td class="align-left">{!! Form::open(['url'=> route('destroy',[$article->alias]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
                    <input type="hidden" name="_method" value="DELETE">
                {!! Form::button('Delete',['class'=>'btn btn-french-5','type' => 'submit']) !!}
                {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>
    {!! Html::link(route('create'),'Add new article',['class'=>'btn btn-the-salmon-dance-3']) !!}
</div>
        </div>

   @endif
