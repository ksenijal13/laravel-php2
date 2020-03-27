<form name="users-form" id="users-form">
    <table class="table-admin" id="users-table">
        <tr>
            <th>
                Id
            </th>
            <th>
                Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                Email
            </th>
            <th>
                Username
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
        @foreach($users as $u)
            <tr>
                <td>
                    {{$u->user_id}}
                    <input type="hidden" name="user-id" value="{{$u->user_id}}"/>
                </td>
                <td>
                    {{$u->first_name}}
                </td>
                <td>
                  {{$u->last_name}}
                </td>
                <td>{{$u->email}}</td>
                <td>{{$u->username}}</td>
                <td>
                    <button type="button" data-id="{{$u->user_id}}" class="btn-admin btn-delete-user">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>
</form>


