<form name="soc-networks-main-form" id="soc-networks-main-form"
      method="POST" action="{{url('/contact/update')}}" >
    @csrf
    <table class="table-admin" id="contact-table-admin">
        <tr>
            <th>
                Id
            </th>
            <th>
                Phone
            </th>
            <th>
                Email
            </th>
            <th>
                Address
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
            <tr>
                <td>
                    {{$contact->id}}
                    <input type="hidden" name="contact-id" value="{{$contact->id}}"/>
                </td>
                <td>
                    <input type="text" id="contact-phone" name="contact-phone" value="{{$contact->phone}}"/>
                </td>
                <td>
                     <input type="text" id="contact-email" name="contact-email" value="{{$contact->email}}"/>
                </td>
                <td>
                    <input type="text" id="contact-address" name="contact-address" value="{{$contact->address}}"/>
                </td>
                <td>
                    <input type="submit" class="btn-admin" name="contact-admin-btn" value="Update"/>
                </td>
            </tr>
    </table>
</form>

