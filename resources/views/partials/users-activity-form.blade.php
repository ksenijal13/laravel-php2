<form name="users-form" id="users-form">
    <table class="table-admin" id="users-activity-table">
        <tr>
            <th>
                User Id
            </th>
            <th>
                Username
            </th>
            <th>
                Activity
            </th>
            <th>
                IP Address
            </th>
            <th>Date</th>
        </tr>
        @foreach($activities as $a)
            <tr>
                <td>
                    {{$a->userId}}
                </td>
                <td>
                    {{$a->username}}
                </td>
                <td>{{$a->activity}}</td>
                <td>{{$a->ip_address}}</td>
                <td>{{$a->date}}</td>
            </tr>
        @endforeach
    </table>
</form>



