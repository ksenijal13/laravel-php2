<form name="soc-networks-main-form" id="soc-networks-main-form" enctype="multipart/form-data"
      method="POST" action="{{url('/users/insert')}}" onsubmit="return insertAdmin();">
    @csrf;
    <table class="table-admin">
        <tr>
            <th>
                First Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                Username
            </th>
            <th>
                Password
            </th>
            <th>
                Repeat Password
            </th>
            <th>
                Email
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>
        <tr>
            <td>
                <input type="text" name="first_name" id="first-name-insert"/>
                <input type="hidden" name="role_id" value="1"/>
            </td>
            <td>
                <input type="text" name="last_name" id="last-name-insert"/>
            </td>
            <td>
                <input type="text" name="username_signup" id="username-insert"/>
            </td>
            <td>
                <input type="password" name="password_signup" id="password-insert"/>
            </td>
            <td>
                <input type="password" name="repeat_password" id="repeat-password-insert"/>
            </td>
            <td>
                <input type="email" name="user_email" id="email-insert"/>
            </td>
            <td>
                <input type="submit" class="btn-admin" id="insert-admin-btn" name="insert-admin-btn" type="button" value="Insert"/>
            </td>
        </tr>
    </table>
</form>



