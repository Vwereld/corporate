

        <div id="content-page" class="content group">
<div class="hentry group">
    <h3 class="title_page">Users </h3>
    <div class="short-table white">
        <table style="width:100%" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Login</th>
            <th>Role</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @if($users)
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{!! Html::link(route('users.edit', ['users'=>$user->id]),$user->name) !!}</td>
                <td>{{($user->email)}}</td>
                <td>{{($user->login)}}</td>
                <td>{{($user->roles->implode('name',', '))}}</td>
                <td>{!! Form::open(['url'=>route('users.destroy',['users' => $user->id]),'class'=>'form-horizontal', 'method'=>'POST']) !!}
                    {{method_field('DELETE')}}
                    {!! Form::button('Delete',['class'=>'btn btn-french-5','type' => 'submit']) !!}
                {!! Form::close() !!}
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
        </table>
    </div>
    {!! Html::link(route('users.create'),'Add new user',['class'=>'btn btn-the-salmon-dance-3']) !!}
</div>
        </div>
