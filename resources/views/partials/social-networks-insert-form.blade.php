<form name="soc-networks-main-form" id="soc-networks-main-form"
      method="POST" action="{{url('/social-networks/store')}}"  onsubmit="return insertSocNetworks();">
    @csrf;
    <table class="table-admin">
        <tr>
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
            <tr>
                <td>
                    <input type="text" name="soc-network-name-insert" id="soc-network-name-insert"/>
                </td>
                <td>
                    <input type="text" name="soc-network-icon-insert" id="soc-network-icon-insert" value="<li class='fa fa-example'></li>"/>
                </td>
                <td>
                    <input type="text" name="soc-network-url-insert" id="soc-network-url-insert" value="https://www.example.com"/>
                </td>
                <td>
                    <input type="submit" class="btn-admin" id="insert-soc-network-btn" name="insert-soc-network-btn" type="button" value="Insert"/>
                </td>
            </tr>
    </table>
</form>

