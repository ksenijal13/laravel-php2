<form name="soc-networks-main-form" id="soc-networks-main-form"
      method="POST" action="{{url('/social-networks/update')}}"  onsubmit="return updateSocialNetwork();">
    @csrf
    <table class="table-admin" id="collections-main-table">
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
        </tr>
        @foreach($admins as $a)
            <tr>
                <td>
                    {{$a->user_id}}
                    <input type="hidden" name="collection-id" value="{{$a->user_id}}"/>
                </td>
                <td>
                    {{$a->first_name}}
                </td>
                <td>
                    {{$a->last_name}}
                </td>
                <td>{{$a->email}}</td>
                <td>{{$a->username}}</td>
            </tr>
        @endforeach
    </table>
</form>



