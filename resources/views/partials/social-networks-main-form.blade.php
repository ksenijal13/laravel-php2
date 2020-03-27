<form name="soc-networks-main-form" id="soc-networks-main-form"
      method="POST" action="{{url('/social-networks/update')}}"  onsubmit="return updateSocialNetwork();">
    @csrf
    <table class="table-admin" id="soc-net-main-table">
        <tr>
            <th>
                Id
            </th>
            <th>
                Name
            </th>
            <th>
                Icon
            </th>
            <th>
                Url
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
        @foreach($socialNetworks as $s)
            <tr>
                <td>
                    {{$s->id}}
                    <input type="hidden" name="soc-network-id" value="{{$s->id}}"/>
                </td>
                <td>
                    <input type="text" id="soc-network-name{{$s->id}}" name="soc-network-name{{$s->id}}" value="{{$s->name}}"/>
                </td>
                <td>
                    <?= $s->icon ?> <input type="text" id="soc-network-icon{{$s->id}}" name="soc-network-icon{{$s->id}}" value="{{$s->icon}}"/>
                </td>
                <td>
                    <input type="text" id="soc-network-url{{$s->id}}" name="soc-network-url{{$s->id}}" value="{{$s->url}}"/>
                </td>
                <td>
                    <button data-id="{{$s->id}}" class="edit-soc-network-btn btn-admin" type="button" name="edit-sock-network-btn">Update</button>
                    <button data-id="{{$s->id}}" class="soc-network-delete_btn btn-admin" type="button">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>
</form>
