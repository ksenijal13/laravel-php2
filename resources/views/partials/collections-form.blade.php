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
                Image
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
        @foreach($collections as $c)
            <tr>
                <td>
                    {{$c->collection_id}}
                    <input type="hidden" name="collection-id" value="{{$c->collection_id}}"/>
                </td>
                <td>
                    <!--<input type="text" id="soc-network-name{{$c->collection_id}}" name="soc-network-name" value=""/>-->
                    {{$c->collection_name}}
                </td>
                <td id="collection-image-form">
                    <!-- <input type="text" id="soc-network-icon" name="soc-network-icon" value=""/>-->
                    <img src="{{asset('/assets/img/'.$c->image)}}" alt="{{$c->collection_name}}"/>
                </td>
                <td>
                    <button data-id="{{$c->collection_id}}" class="edit-collection-btn btn-admin" type="button" name="edit-sock-network-btn">Update</button>
                    <button data-id="{{$c->collection_id}}" class="collection-delete_btn btn-admin" type="button">Delete</button>
                </td>
            </tr>
        @endforeach
    </table>
</form>

