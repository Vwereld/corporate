<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url'=>(isset($user->id)) ? route('users.update',['users'=>$user->id]) : route('users.store'),'class'=> 'contact-form', 'method' =>'POST','enctype' =>'multipart/form-data']) !!}
        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Name:</span>
                    <br/>
                    <span class="sublabel">name:</span>
                    <br/>
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($user->name) ? $user->name : old('name'), ['placeholder' =>'Enter name']) !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Login:</span>
                    <br/>
                    <span class="sublabel">login:</span>
                    <br/>
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('login',isset($user->login) ? $user->login : old('login'),['placeholder' =>'Enter login']) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Email:</span>
                    <br/>
                    <span class="sublabel">email:</span>
                    <br/>
                </label>
                <div class="input-prepend">
                    {!! Form::text('email', isset($user->email) ? $user->email : old('email')) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Password:</span>
                    <br/>
                    <span class="sublabel">password:</span>
                    <br/>
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password') !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Repeat password:</span>
                    <br/>
                    <span class="sublabel">Repeat password:</span>
                    <br/>
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password_confirmation') !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Role:</span>
                    <br/>
                    <span class="sublabel">role:</span>
                    <br/>
                </label>
                <div class="input-prepend">
                    {!! Form::select('role_id',$roles, (isset($user)) ? $user->roles()->first()->id : null) !!}
                </div>
            </li>
            @if(isset($user->id))
                <input type="hidden" name="_method" value="PUT">
                @endif
            <li class="submit-button">
                {!! Form::button('Save',['class'=>'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
            </li>
        </ul>


        {!! Form::close() !!}

    </div>
</div>
