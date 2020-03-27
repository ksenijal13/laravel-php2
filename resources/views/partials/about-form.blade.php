<form name="soc-networks-main-form" id="soc-networks-main-form" enctype="multipart/form-data"
      method="POST" action="{{url('/about/update')}}" >
    @csrf
    <table class="table-admin" id="contact-table-admin">
        <tr>
            <th>
                Id
            </th>
            <th>
                Image
            </th>
            <th>
                Biography
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
        <tr>
            <td>
                {{$about->a_id}}
                <input type="hidden" name="about-id" value="{{$about->a_id}}"/>
            </td>
            <td id="about-me-image">
                <img src="{{asset('/assets/img/'.$about->image)}}" alt="{{$about->alt}}"/>
                <input type="file" id="about-image" name="about-image"/>
            </td>
            <td>
              <textarea id="about-biography" name="about-biography">{{$about->biography}}</textarea>
            </td>
            <td>
                <input type="submit" class="btn-admin" name="contact-admin-btn" value="Update"/>
            </td>
        </tr>
    </table>
</form>


