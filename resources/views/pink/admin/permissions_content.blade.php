<div class="content group" id="content-page">
    <div class="hentry group">
        <h3 class="title_page">Privileges</h3>
        <form action="{{route('permissions.store')}}" method="POST">
            {{csrf_field()}}
            <div class="short-table white">
                <table style="width: 100%;">
                    <thead>
                    <th>Privileges</th>
                    @if(!$roles->isEmpty())
                        @foreach($roles as  $item)
                            <th>{{$item->name}}</th>
                            @endforeach
                        @endif
                    </thead>
                    <tbody>
                    @if(!$priv->isEmpty())
                        @foreach($priv as $val)
                            <tr>
                                <td>{{$val->name}}</td>
                                @foreach($roles as $role)
                                    <td>
                                        @if($role->hasPermission($val->name))
                                    <input checked name="{{$role->id}}[]" type="checkbox" value="{{$val->id}}">
                                            @else
                                            <input name="{{$role->id}}[]" type="checkbox" value="{{$val->id}}">
                                            @endif
                                    </td>
                                    @endforeach
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <input class="btn btn-the-salmon-dance-3" type="submit" value="Update permission"/>
        </form>
    </div>
</div>