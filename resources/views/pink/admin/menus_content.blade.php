<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Users</h3>
        <div class="short-table white">
            <table style="width: 100%;" cellpadding="0" cellspacing="0">
                <thead>
                <th>Name</th>
                <th>Link</th>
                <th>Delete</th>
                </thead>
                @if($menus)
                    @include(env('THEME').'.admin.custom-menu-items', ['items'=>$menus->roots(),'paddingLeft' =>''])
                    @endif
            </table>
        </div>
        {!! Html::link(route('menus.create'),'Add menu',['class'=>'btn btn-the-salmon-dance-3']) !!}
    </div>
</div>
