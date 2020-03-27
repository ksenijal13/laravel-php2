<h2>Add new socks</h2>
<form enctype="multipart/form-data" name="insert_sock_form" id="insert_sock_form"
      method="POST" action="{{url('/socks/store')}}"  onsubmit="return insertValidation();">
    @csrf
    <table id="insert_table">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Category</th>
            <th>Collection</th>
            <th>Collor</th>
            <th><i class="fa fa-edit"></i></th>
        </tr>
        <tr>
            <td><input type="text" name="insert-sock-name" id="insert-sock-name"/></td>
            <td><input type="file" name="insert-sock-file" id="insert-sock-file"/></td>
            <td><input type="price" name ="insert-sock-price" id="insert-sock-price"/></td>
            <td>
                <select name="insert-sock-cat" id="insert-sock-cat">
                    <option value="0">Choose category</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->cat_id}}">{{$cat->cat_name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select name="insert-sock-coll" id="insert-sock-coll">
                    <option value="0">Choose collection</option>
                    @foreach($collections as $coll): ?>
                        <option value="{{$coll->collection_id}}">{{$coll->collection_name}}</option>
                    @endforeach
                </select>
            </td>
            </td>
            <td>
                <select name="insert-sock-color" id="insert-sock-color">
                    <option value="0">Choose color</option>
                    @foreach($colors as $color)
                        <option value="{{$color->color_id}}">{{$color->color_name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="submit" class="edit_btn" id="insert_sock_btn" name="insert_sock_btn" type="button" value="Insert"/>
            </td>
        </tr>
    </table>
</form>

