<form name="all_photos_info_form" id="all_photos_info_form">
    <table id="all_photos_table">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Collection</th>
            <th><i class="fa fa-edit"></i></th>
        </tr>
        @foreach($socks as $sock)
        <tr>
            <td>{{$sock->id}}</td>
            <td>{{$sock->name}}</td>
            <td class="td_img"><img src="{{asset('/assets/img/'.$sock->sock_image)}}" alt="{{$sock->name}}"/></td>
            <td>{{$sock->price}}&#36;</td>
            <td>{{$discount = ($sock->discount != null) ? $sock->discount : 0}}%</td>
            <td>{{$sock->cat_name}}</td>
            <td>{{$collection = ($sock->collection_name != null) ? $sock->collection_name : "none"}}</td>
            <td>
                <button data-id="{{$sock->id}}" class="edit_btn update_btn" type="button">Update</button>
                <button data-id="{{$sock->id}}" class="edit_btn delete_btn" data-limit="" type="button">Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
</form>
