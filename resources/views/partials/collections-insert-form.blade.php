<form name="soc-networks-main-form" id="soc-networks-main-form" enctype="multipart/form-data"
      method="POST" action="{{url('/collection/insert')}}">
    @csrf;
    <table class="table-admin">
        <tr>
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
        <tr>
            <td>
                <input type="text" name="collection-name-insert" id="collection-name-insert"/>
            </td>
            <td>
                <input type="file" name="collection-image-insert" id="collection-image-insert"/>
            </td>
            <td>
                <input type="submit" class="btn-admin" id="insert-collection-btn" name="insert-collection-btn" type="button" value="Insert"/>
            </td>
        </tr>
    </table>
</form>


