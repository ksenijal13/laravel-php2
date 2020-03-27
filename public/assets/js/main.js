$(document).ready(function(){
    $("#search-link").click(getSearchText);
    $("#user-fa").click(showLoginForm);
    $("#shop-search-socks").keyup(searchSocks);
    $(".color-link").click(filterByColor);
    $("#closeMessage").click(closeMessage);
    $(".collection-delete_btn").click(deleteCollection);
    $(".soc-network-delete_btn").click(deleteSocialNetwork);
    $("#close_update_form").click(function(e){
        $("#update_form_div").hide();
    })
    $(".btn-delete-user").click(deleteUser);
    $(".edit-soc-network-btn").click(updateSocialNetwork);
    //$("#message").hide();
    $("#close-success").click(function(e) {
        e.preventDefault();
        $("#success").hide();
    });
    $("#user-error a").click(function(e){
        e.preventDefault();
        $("#user-error").hide();
    })
    $("#errors").hide();
    $(".socks-pagination-admin").click(sendLimitAdmin);
    $(".delete_btn").click(deleteSock);
    $(".update_btn").click(getDataForUpdateForm);
    $(".edit-collection-btn").click(getDataForUpdateCollectionForm);
    $("#coll-eraser").hide();
    $("#search-element a").click(function(e){e.preventDefault()});
    //$("#btnSignup").click(signUp);
    $("#your-cart").hide();
    $("#coll-eraser").click(clearFilterByCollection);
    $("#select-price option[value=0]").attr('selected', 'selected');
    $("#sort-eraser").hide();
    $("#sort-eraser").click(clearFilterBySort);
    // $("#btnLogin").click(login);
    $(".add-to-cart").click(showAddToCartDiv);
    $(".collection-link").click(filterByCollection);
    $("#update_form_div").hide();
    $("#cart-check-socks").hide();
    $("#color-eraser").hide();
    $("#gender-eraser").hide();
    $("#your-cart-link").click(showYourCart);
    let g = sessionStorage.getItem("gender");
    if(g!=0)
    {
        sessionStorage.removeItem("gender");
    }
    let sort = sessionStorage.getItem("sort");
    if(sort!=0)
    {
        sessionStorage.removeItem("sort");
    }
    let sortActivity = sessionStorage.getItem("sortActivity");
    if(sortActivity!=0)
    {
        sessionStorage.removeItem("sortActivity");
    }
    let coll = sessionStorage.getItem("coll");
    if(coll!=0)
    {
        sessionStorage.removeItem("coll");
    }
    let c = sessionStorage.getItem("color");
    if(c!=0)
    {
        sessionStorage.removeItem("color");
    }
    let check = sessionStorage.getItem("check");
    if(check!=0)
    {
        sessionStorage.removeItem("check");
    }
    checkUser();
    $("#gender-eraser").click(clearFilterByGender);
    $("#color-eraser").click(clearFilterByColor);
    $(".gender-link").click(filterByGender);
    $("#pagination-block ul li #link0").addClass("active");
    // $("#sign-out").click(signOut);
    $("#btn-hide-reg-form").click(hideRegistrationForm);
    $(".socks_pagination").click(sendLimit);
    $(".activity-pagination").click(sendLimitActivity);
    $("#registration-form").hide();
    $("#errors_div").hide();
    $("#select-price").change(sortByPrice);
    $("#sort-activity").change(sortByDate);
    $(".small-image-link").hover(
        function(){
            //mouseover small image
            let id = $(this).data("id");
            let linkId = $(this).attr("id");
            console.log(linkId);
            console.log(id);
            getBigSock(id, linkId);
        },
        function(){
            //mouse out small image
            let linkId = $(this).attr("id");
            let  id = $(this).parent().parent().prev().data("mainimage");
            getBigSock(id, linkId);
        }
    );
});
function deleteUser() {
    let id = $(this).data("id");
    $.ajax({
        url: "users/delete/"+id,
        dataType: "json",
        success: function(data){
            showUsers(data);
        },
        error(xhr,status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showUsers(users){
    let html = `<tr>
            <th>
                Id
            </th>
            <th>
                Name
            </th>
            <th>
                Last Name
            </th>
            <th>
                Email
            </th>
            <th>
                Username
            </th>
            <th>
                <i class="fa fa-edit"></i>
            </th>
        </tr>`;
    for(let u of users.data){
        html += `<tr>
                <td>
                    ${u.user_id}
                    <input type="hidden" name="user-id" value="${u.user_id}"/>
                </td>
                <td>
                    ${u.first_name}
                </td>
                <td>
                  ${u.last_name}
                </td>
                <td>${u.email}</td>
                <td>${u.username}</td>
                <td>
                    <button type="button" data-id="${u.user_id}" class="btn-admin btn-delete-user">Delete</button>
                </td>
            </tr>`;
    }
    $("#users-table").html(html);
    $(".btn-delete-user").click(deleteUser);
}
function deleteCollection(){
    let id = $(this).data("id");
    $.ajax({
        url: "collections/delete/"+id,
        dataType: "json",
        success: function(data){
            showCollections(data);
        },
        error(xhr,status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showCollections(data) {
    let html = `<tr>
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
        </tr>`;

    for(let c of data){
        html += `<tr>
                <td>
                    ${c.collection_id}
                    <input type="hidden" name="collection-id" value="{{$c->collection_id}}"/>
                </td>
                <td>
                    ${c.collection_name}
                </td>
                <td id="collection-image-form">
                    <img src="${urlImg}/${c.image}" alt="${c.collection_name}"/>
                </td>
                <td>
                    <button data-id="${c.collection_id}" class="edit-collection-btn btn-admin" type="button" name="edit-sock-network-btn">Update</button>
                    <button data-id="${c.collection_id}" class="collection-delete_btn btn-admin" type="button">Delete</button>
                </td>
            </tr>`;
    }
    $("#collections-main-table").html(html);
}
function deleteSocialNetwork(){
    let id = $(this).data("id");
    $.ajax({
        url: "social-networks/delete/"+id,
        dataType: "json",
        success: function(data){
            showSocialNetworks(data);
        },
        error(xhr,status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showSocialNetworks(data){
    let html = " <tr>\n" +
        "            <th>\n" +
        "                Id\n" +
        "            </th>\n" +
        "            <th>\n" +
        "                Name\n" +
        "            </th>\n" +
        "            <th>\n" +
        "                Icon\n" +
        "            </th>\n" +
        "            <th>\n" +
        "                Url\n" +
        "            </th>\n" +
        "            <th>\n" +
        "                <i class=\"fa fa-edit\"></i>\n" +
        "            </th>\n" +
        "        </tr>";
    for(let s of data){
        html += `<tr>
                <td>
                    ${s.id}
                    <input type="hidden" name="soc-network-id" value="${s.id}"/>
                </td>
                <td>
                    <input type="text" name="soc-network-name${s.id}" id="soc-network-name${s.id}" value="${s.name}"/>
                </td>
                <td>
                    ${s.icon} <input type="text" name="soc-network-icon${s.id}" id="soc-network-icon${s.id}" value='${s.icon}'/>
                </td>
                <td>
                    <input type="text" name="soc-network-url${s.id}" id="soc-network-url${s.id}" value="${s.url}"/>
                </td>
                <td>
                    <button data-id="${s.id}" class="edit-soc-network-btn btn-admin" type="button" name="edit-sock-network-btn">Update</button>
                    <button data-id="${s.id}" class="soc-network-delete_btn btn-admin" data-limit="" type="button">Delete</button>
                </td>
            </tr>`;
    }
    $("#soc-net-main-table").html(html);
    $(".edit-soc-network-btn").click(updateSocialNetwork);
    $(".soc-network-delete_btn").click(deleteSocialNetwork);
}
function closeMessageAjax(e) {
e.preventDefault()
    $("#message").html();
}
function updateSocialNetwork() {
    let validate = true;
    let id = $(this).data("id");
    let errors = [];
    let name = $("#soc-network-name"+id).val();
    let icon = $("#soc-network-icon"+id).val();
    let url = $("#soc-network-url"+id).val();
    console.log(name);
    let nameReg = /[a-z]{2,}/;
    if(!nameReg.test(name)){
        errors.push("Name must be at least 2 character long, and can contain only lowerkeys letters.");
    }
    if(!errors.length){
        $.ajax({
            url: "social-networks/update",
            method: "post",
            dataType: "json",
            data: {
                name: name,
                icon: icon,
                url: url,
                id: id,
                _token: $("input[name='_token']").val()
            },
            success: function(data){
                $("#message").show();
                console.log("uslo u successs");
               // showSocialNetworks(data);
                html = `<ul><li>You've successfully updated data.</li></ul><p class='admin_ok'><a id='closeMessage' href=''>OK</a></p>`;
                $("#message").html(html);
                $("#closeMessage").click(closeMessage);
                showSocialNetworks(data);
                //alert(errors);
            },
            error: function(xhr, status){
                if(xhr.status == 422){
                    html = `<ul><li>Url is not in valid form.</li></ul><p class='admin_ok'><a id='closeMessage' href=''>OK</a></p>`;
                    $("#message").html(html);
                    $("#closeMessage").click(closeMessage);
                }
            }
        })
    }else{
        validate = false;
        let html = "<ul>";
        for(let i = 0; i < errors.length; i++){
            html += `<li>${errors[i]}</li>`;
        }
        html += "</ul><p class='admin_ok'><a id='closeError' href=''>OK</a></p>";
        $("#errors").show();
        $("#errors").html(html);
        $("#closeError").click(closeErrors);
    }
    return validate;
}
function insertSocNetworks() {
    let errors = [];
    var name = $("#soc-network-name-insert").val();
    console.log(name);
    let validate = true;
    if(name == ""){
        errors.push("Name is required field.");
    }
    var nameReg = /^[a-z]{2,}$/;
    if(!nameReg.test(name)){
        errors.push("Name must be at least 2 character long, and can contain only lowerkeys letters.");
    }
    let icon = $("#soc-network-icon-insert").val();
    if(icon == "<li class='fa fa-example'></li>"){
        errors.push("Please enter valid icon. Example icon is not valid.");
    }
    if(icon == ""){
        errors.push("Icon is required field.");
    }
    let url = $("#soc-network-url-insert").val();
    if(url == "https://www.example.com"){
        errors.push("Please enter valid url. Example url is not valid.");
    }
    if(url == ""){
        errors.push("Url is required field.");
    }
    console.log(errors);
    if(!errors.length){
       validate = true;
    }else{
        validate = false;
        let html = "<ul>";
        for(let i = 0; i < errors.length; i++){
            html += `<li>${errors[i]}</li>`;
        }
        html += "</ul><p class='admin_ok'><a id='closeError' href=''>OK</a></p>";
        $("#errors").show();
        $("#errors").html(html);
        $("#closeError").click(closeErrors);
    }
    return validate;

}
function fetch_data(page)
{
    $.ajax({
        url:"socks/pagination/fetch_data?page="+page,
        success:function(data)
        {
            showSocks(data);
        }
    });
}
function closeMessage(e) {
    e.preventDefault();
    $("#message").hide();
}
function sendLimitAdmin(e){
    e.preventDefault();
    let limit = $(this).data("limit");
    sessionStorage.setItem("adm-limit", limit);
    $("#pagination-block ul li a").removeClass("active");
    $(this).addClass("active");
    $.ajax({
        url: "admin/socks"+limit,
        method: "get",
        dataType: "json",
        success: function(socks){
            showSocksAdmin(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function showSocksAdmin(socks){
    let html = `<tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Collection</th>
            <th><i class="fa fa-edit"></i></th>
        </tr>`;
    for(let sock in socks) {
        if (socks != null) {
            html += ` <tr>
                <td>${socks[sock].id}</td>
                <td>${socks[sock].name}</td>
                <td class="td_img"><img src="${urlImg}/${socks[sock].sock_image}" alt="${socks[sock].name}"</td>
                <td>${socks[sock].price}&#36;</td>
                <td>`;
            let discount = (socks[sock].discount != null) ? socks[sock].discount : 0;
            html += `${discount}%</td>
                <td>${socks[sock].cat_name}</td>`;
            let collection = (socks[sock].collection_name != null) ? socks[sock].collection_name : "none";
            html += `<td>${collection}</td>
                <td>
                    <button data-id="${socks[sock].id}" class="edit_btn update_btn" type="button">Update</button>
                    <button data-id="${socks[sock].id}" class="edit_btn delete_btn" type="button">Delete</button>
                </td>
            </tr>`;
        }
    }
    $("#all_photos_table").html(html);
    $(".delete_btn").click(deleteSock);
    $(".update_btn").click(getDataForUpdateForm);
}
function getDataForUpdateCollectionForm(){
    let id = $(this).data("id");
    $.ajax({
        url: "collections/"+id,
        method: "get",
        dataType: "json",
        success: function(collections){
            showUpdateFormCollections(collections);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}

function getDataForUpdateForm(){
    let id = $(this).data("id");
    $.ajax({
        url: "admin/sock/"+id,
        method: "get",
        dataType: "json",
        success: function(sock){
            showUpdateForm(sock);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });

}
function showUpdateFormCollections(coll) {
    $("#update_form_div").show();
    let html = `
    <tr>
         <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th><i class="fa fa-edit"></i></th>
    </tr>
    <tr>
        <td><input readonly type="text" id="collection-id" name="collection-id" value="${coll.collection_id}"/></td>
        <td id="update-img"><img src="${urlImg}/${coll.image}"/>
        <input type="file" name="collection-image" id="collection-image"/>
        </td>
        <td><input type="text" name="collection-name" value="${coll.collection_name}"</td>
            <td>
        <input type="submit" class="edit_btn" id="update_collection_btn" name="update_collection_btn" type="button" value="Update"/>
    </td>
    </tr>`;
    $(".upd-table").html(html);
    $("#close_update_form").click(function(e){
        $("#update_form_div").hide();
    })
}
function showUpdateForm(sock){
    console.log(sock);
    $("#update_form_div").show();
    let html = `
    <tr>
         <th>Id</th>
            <th>Image</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Collection</th>
            <th><i class="fa fa-edit"></i></th>
    </tr>
    <tr>
        <td><input readonly type="text" id="sock_id" name="sock_id" value="${sock.id}"/></td>
        <input readonly type="hidden" id="mother_id" name="mother_id" value="${sock.id_sock}"/>
        <td id="update-img"><img src="${urlImg}/${sock.sock_image}"/>
        <input type="file" name="file" id="sock-img"/>
        </td>
         <td><input type="text" id="sock_price" name="sock_price" value="${sock.price}"/></td>`;
    let discount = (sock.discount != null) ? sock.discount : 0;
    html += `<td><input type="text" id="sock_discount" name="sock_discount" value="${discount}"/></td>
           <td id="update-category"></td>
           <td id="update-collection"></td>
            <td>
        <input type="submit" class="edit_btn" id="update_sock_btn" name="update_sock_btn" type="button" value="Update"/>
    </td>
    </tr>`;
    getCategories(sock.category_id);
    getCollections(sock.coll_id);
    $(".upd-table").html(html);
    $("#close_update_form").click(function(e){
        $("#update_form_div").hide();
    })
}
function updateValidation(){
    let errors = [];
    let price = $("#sock_price").val();
    let discount = $("#sock_discount").val();
    let coll = $("#coll-list-update").val();
    let cat = $("#cat-list-update").val();
    let validate = true;

    let discountReg = /^[0-9]{1,}$/;
    if(discount != ""){
        if(!discountReg.test(discount)){
            errors.push("Discount must be number. ");
        }
    }

    let priceReg = /^[0-9]{1,}$/;
    if(price != ""){
        if(!priceReg.test(price)){
            errors.push("Price must be number. ");
        }
    }

        /*if((price == "") && ( document.getElementById("photo_img").files.length == 0) && (discount == "0") && (coll == "0") && (cat == "0")){
        validate = false;
        error = "false";
        console.log("uslo u if &&");
    }
    else{
        console.log("uslo u else");
        validate = true;
    }*/
    if(errors.length){
        validate = false;
        let html = "<ul>";
        for(let i = 0; i < errors.length; i++){
            html += `<li>${errors[i]}</li>`;
        }
        html += "</ul><p class='admin_ok'><a id='closeError' href=''>OK</a></p>";
        $("#errors").show();
        $("#errors").html(html);
        $("#closeError").click(closeErrors);
    }
}
function insertValidation(){
    var validation = false;
    let errors = [];

    let name = $("#insert-sock-name").val();
    if(name == ""){
        errors.push("Please type in a name of sock.");
    }
    let cat = $("#insert-sock-cat").val();
    if(cat == "0"){
        errors.push("Please choose a category.");
    }
    let price = $("#insert-sock-price").val();
    let priceReg = /^[0-9]{1,}$/;
    if(price == ""){
        errors.push("Please type a price.");
    }
    else if(!priceReg.test(price)){
        errors.push("Price must be number. ");
    }
    let color = $("#insert-sock-color").val();
    if(color == "0"){
        errors.push("Please choose a color.");
    }
    let file = $("#insert-sock-file").val();
    console.log(file);
    if(!file.length){
        errors.push("Please choose a photo.");
    }
    if(!errors.length){
        validation = true;
        $("#message").show();
    }
    else {
        validation = false;
        let html = "<ul>";
        for(let i = 0; i < errors.length; i++){
            html += `<li>${errors[i]}</li>`;
        }
        html += "</ul><p class='admin_ok'><a id='closeError' href=''>OK</a></p>";
        $("#errors").show();
        $("#errors").html(html);
        $("#closeError").click(closeErrors);
    }
    console.log(errors);
    console.log(validation);
    return validation;
}
function closeErrors(e){
    e.preventDefault();
    $("#errors").hide();
}
function getCollections(collectionId){
    $.ajax({
        url: "collections",
        method: "get",
        dataType: "json",
        success: function(collections){
            let html = `<select id="coll-list-update" name="coll-list-update">  <option value="0">Choose collection...</option>`;
            for(let coll of collections){
                if(collectionId == coll.collection_id){
                    html += `<option selected value="${coll.collection_id}"> ${coll.collection_name}</option>`;
                }else{
                    html += `<option value="${coll.collection_id}"> ${coll.collection_name}</option>`;
                }

            }
            html += `</select>`;
            $("#update-collection").html(html);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function getCategories(categoryId){
    $.ajax({
        url: "categories",
        method: "get",
        dataType: "json",
        success: function(categories){
            let html = `<select id="cat-list-update" name="cat-list-update">  <option value="0">Choose category...</option>`;
            for(let cat of categories){
                if(cat.cat_id == categoryId){
                    html += `<option selected value="${cat.cat_id}"> ${cat.cat_name}</option>`;
                }else{
                    html += `<option value="${cat.cat_id}"> ${cat.cat_name}</option>`;
                }
            }
            html += `</select>`;
            $("#update-category").html(html);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function deleteSock(){
    let id = $(this).data("id");
    console.log(id);
    let limit = sessionStorage.getItem("adm-limit");
    if(limit == null){
        limit = 0;
    }
    console.log(limit);
    $.ajax({
        url: "admin/delete/sock",
        method: "get",
        dataType: "json",
        data: {
            limit: limit,
            id: id
        },
        success: function(socks){
            showSocksAdmin(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function showYourCart(e) {
    console.log("uslo u show cart");
    e.preventDefault();
    $.ajax({
        url: "cart/show",
        method: "get",
        dataType: "json",
        success: function(socks){
            showYourCartData(socks);
            console.log("uslo u succe");
            $("#your-cart").show();
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showYourCartData(socks){
    let socksLength = socks.length;
    let subtotal = 0;
    $("#your-cart").show(500);
    let html = `<h4>Your Cart</h4><a href="#" id="close-cart"><span class="fa fa-times" aria-hidden="true"></span></a>`;
    for(let sock in socks){
        console.log(sock);
        subtotal += socks[sock].price * socks[sock].quantity;
        html += `<div class="cart-socks flex-element">
                 <a href="#" class="delete-from-cart" data-id="${socks[sock].cart_id}"><span class="fa fa-times" aria-hidden="true"></span></a>
                    <div class="cart-img">
                        <img src="${urlImg}/${socks[sock].small_image}" alt=""/>
                    </div>
                    <div class="quantity-price flex-element">
                       <a href="#" data-id="${socks[sock].cart_id}" data-sum="minus" data-quantity = "${socks[sock].quantity}" class="update-quantity-minus">-</a>
                       <p>${socks[sock].quantity}</p>
                       <a href="#" data-id="${socks[sock].cart_id}" data-sum="plus" data-quantity = "${socks[sock].quantity}" class="update-quantity-plus">+</a>
                    </div>
                    <div class="price">`;
        if(socks[sock].discount > 0){
            let price = socks[sock].price - (socks[sock].discount / 100 * socks[sock].price);
            html += `$ ${socks[sock].quantity * Math.round(price)}`;
        }else{
            html += `${socks[sock].quantity * Math.round(socks[sock].price)}`;
        }
        html +=`</div>
                </div>`;
    }
    html += `<p id="subtotal">Subtotal: ${subtotal}`;
    $("#your-cart").html(html);
    if(!socksLength){
        $("#your-cart").html("<h4>Your Cart is Empty</h4><a href=\"#\" id=\"close-cart\"><span class=\"fa fa-times\" aria-hidden=\"true\"></span></a>");
    }
    $("#close-cart").click(function(e){
        e.preventDefault();
        $("#your-cart").hide();
    });
    $(".update-quantity-plus").click(updateQuantity);
    $(".update-quantity-minus").click(updateQuantity);
    $(".delete-from-cart").click(deleteFromCart);

}
function updateQuantity(e){
    e.preventDefault();
    let id = $(this).data("id");
    let quantity = $(this).data("quantity");
    let sum = $(this).data("sum");
    if(quantity == 1 && sum == "minus"){
        $.ajax({
            url: "cart/delete/"+id,
            method: "get",
            dataType: "json",
            success: function(socks){
                showYourCartData(socks);
                console.log("uslo u succe");
                console.log(socks);
            },
            error: function(xhr, status, error){
                console.warn(xhr.responseText);
            }
        })
    }
    else{
        if (sum == "plus") {
            quantity++;
        } else {
            quantity--;
        }
        $.ajax({
            url: "cart/update",
            method: "get",
            dataType: "json",
            data: {
                id: id,
                quantity: quantity
            },
            success: function (data) {
                console.log("carape: "+data);
                showYourCartData(data);
                console.log("uslo u succe");
            },
            error: function (xhr, status, error) {
                console.warn(xhr.responseText);
            }
        })
    }
}
function updateQuantityMinus(e) {
    e.preventDefault();
}
function deleteFromCart(e) {
    e.preventDefault()
    let id = $(this).data("id");
    console.log(id);
    $.ajax({
        url: "cart/delete/"+id,
        method: "get",
        dataType: "json",
        success: function(socks){
            showYourCartData(socks);
            console.log("uslo u succe");
            console.log(socks);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showAddToCartDiv(e){
    e.preventDefault();
    let id = $(this).data("mother");
    $.ajax({
        url: "socks/smallImages/"+id,
        method: "get",
        dataType: "json",
        success: function(socks){
            showAddDiv(socks);
            console.log("uslo u success");
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    })
}
function showAddDiv(socks) {
    $("#cart-check-socks").show(700);
    let html = `<h4>Soon Yours</h4><a href="#" id="close-add"><span class="fa fa-times" aria-hidden="true"></span></a>`;
    for(let sock in socks) {
        html += `<div class="check-sock">
                <img src="${urlImg}/${socks[sock].small_image}" alt=""/>
                <input type="checkbox" name="cart-socks" value="${socks[sock].id}"/>
            </div>`;
    }
    html += `<a href="#" id="add-to-your-cart">Add to Cart</a>`;
    $("#cart-check-socks").html(html);
    $("#close-add").click(function(e){
        $("#cart-check-socks").hide();
    });
    $("#add-to-your-cart").click(addToCart);
}
function addToCart(e) {
    e.preventDefault();
    var socks = [];
    $.each($("input[name='cart-socks']:checked"), function(){
        socks.push($(this).val());
    });
    if(!socks.length){
        alert("You haven't checked anything.");
    }
    else {
        $.ajax({
            url: "cart",
            method: "get",
            data: {
                socksArray: socks
            },
            success: function(data, textStatus, xhr){
                console.log(data);
                if(xhr.status == 201){
                    alert("You've successfully added socks in your cart.");
                }
                $("#cart-check-socks").hide();
            },
            error: function(xhr, status, error){
                if(xhr.status == 409){
                    alert("This product is already in your cart.");
                }
            }
        })
    }
    console.log(socks);

}
function clearFilterBySort(e) {
    // $("#select-price option[value=0]").attr('selected', 'selected');
    $("#select-price").val(0);
    e.preventDefault();
    sessionStorage.removeItem("sort");
    let color = sessionStorage.getItem("color");
    if(color == null){
        color = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            searchValue: 0,
            gender: gender,
            colorId: color,
            collection: collection,
            sortPrice: 0
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
    $(this).hide();
}

function sortByPrice(){
    let sortPrice = $(this).val();
    console.log(sortPrice);
    $("#shop-search-socks").val("");
    $("#sort-eraser").show(700);
    sessionStorage.setItem("sort", sortPrice);
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    sessionStorage.setItem("linkId", "link0");
    let colorId = sessionStorage.getItem("color");
    console.log("Boja je: " +colorId);
    if(colorId == null){
        colorId = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            gender: gender,
            colorId: colorId,
            collection: collection,
            sortPrice: sortPrice
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });

}
function  filterByCollection(e){
    $("#shop-search-socks").val("");
    $("#collection-list li a").removeClass("active-coll");
    $(this).addClass("active-coll");
    e.preventDefault();
    $("#coll-eraser").show(700);
    //let gender = $(this).data("gender");
    //sessionStorage.setItem("gender", gender);
    let collection = $(this).data("id");
    sessionStorage.setItem("coll", collection);
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    sessionStorage.setItem("linkId", "link0");
    let colorId = sessionStorage.getItem("color");
    console.log("Boja je: " +colorId);
    if(colorId == null){
        colorId = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            gender: gender,
            colorId: colorId,
            collection: collection,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });

}
function clearFilterByCollection(e) {
    $("#collection-list li a").removeClass('active-coll');
    e.preventDefault();
    sessionStorage.removeItem("coll");
    let color = sessionStorage.getItem("color");
    if(color == null){
        color = 0;
    }
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            searchValue: 0,
            gender: gender,
            colorId: color,
            collection: 0,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
    $(this).hide();
}
function clearFilterByGender(e){
    $("#gender-list li a").removeClass('active-gender');
    e.preventDefault();
    sessionStorage.removeItem("gender");
    let color = sessionStorage.getItem("color");
    if(color == null){
        color = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            searchValue: 0,
            gender: 0,
            colorId: color,
            collection: collection,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
    $(this).hide();
}
function filterByGender(e){
    $("#shop-search-socks").val("");
    $("#gender-list li a").removeClass("active-gender");
    $(this).addClass("active-gender");
    e.preventDefault();
    $("#gender-eraser").show(700);
    let gender = $(this).data("gender");
    sessionStorage.setItem("gender", gender);
    let gg = sessionStorage.getItem("gender");
    console.log("gender iz filtera je: " + gg);
    sessionStorage.setItem("linkId", "link0");
    let colorId = sessionStorage.getItem("color");
    console.log("Boja je: " +colorId);
    if(colorId == null){
        colorId = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    $(this).addClass('active-gender');
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            gender: gender,
            colorId: colorId,
            collection: collection,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function clearFilterByColor(e) {
    $("#colors-list a").removeClass("active-color");
    sessionStorage.removeItem("color");
    sessionStorage.setItem("linkId", "link0");
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    e.preventDefault();
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            searchValue: 0,
            gender: gender,
            collection: collection,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
    $(this).hide();
}
function filterByColor(e){
    $("#shop-search-socks").val("");
    e.preventDefault();
    $("#colors-list a").removeClass("active-color");
    $("#color-eraser").show(700);
    $(this).addClass('active-color');
    let colorId = $(this).data("id");
    sessionStorage.setItem("color", colorId);
    console.log(colorId);
    sessionStorage.setItem("linkId", "link0");
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    let collection = sessionStorage.getItem("coll");
    if(collection == null){
        collection = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    $.ajax({
        url: "socks",
        method: "get",
        data: {
            colorId : colorId,
            gender: gender,
            collection: collection,
            sortPrice: sort
        },
        dataType: 'json',
        success: function(socks){
            console.log("sve ok");
            showSocks(socks);
        },
        error: function(xhr, status, error){
            console.log(error);
            console.warn(xhr.responseText);
        }
    });
}
function searchSocks(){
    $("#colors-list a").removeClass("active-color");
    $("#color-eraser").hide();
    $("#gender-eraser").hide();
    $("#coll-eraser").hide();
    $("#sort-eraser").hide();
    sessionStorage.setItem("linkId", "link0");
    var searchVal = $(this).val();
    $.ajax({
        url: "socks",
        method: "get",
        data: {
            searchValue : searchVal,
            limit: 0
        },
        dataType: 'json',
        success: function(socks){
            console.log("sve ok");
            showSocks(socks);
        },
        error: function(xhr, status, error){
            console.log(error);
            console.warn(xhr.responseText);
        }
    });
}
function insertAdmin(){
    var validation = 0;
    var errorsArray = [];

    var firstName = $("#first-name-insert").val();
    var firstNameReg = /^[A-Z][a-z]{2,13}(\s[A-Z][a-z]{2,13})*$/;

    if(firstName == ""){
        errorsArray.push("First name is a required field.");
    }
    else if(!firstNameReg.test(firstName)){
        errorsArray.push("First name must contain only letters and must start with upperkey.");
    }

    var lastName = $("#last-name-insert").val();
    var lastNameReg = /^[A-Z][a-žćčžš]{2,13}(\s[A-Z][a-žćčžš]{2,13})*$/;

    if(lastName == ""){
        errorsArray.push("Last name is a required field.");
    }
    else if(!lastNameReg.test(lastName)){
        errorsArray.push("Last name must contain only letters and must start with upperkey.");
    }

    var username = $("#username-insert").val();
    var usernameReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(username == ""){
        errorsArray.push("Username is a required field.");
    }
    else if(!usernameReg.test(username)){
        errorsArray.push("The username must contain only lowercase letters and numbers,at least 8 characters long.");
    }

    var password = $("#password-insert").val();
    var passwordReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(password== ""){
        errorsArray.push("Password is a required field.");
    }
    else if(!passwordReg.test(password)){
        errorsArray.push("Password must contain only lowercase letters and numbers, at least 8 characters long.");
    }

    var repeatPassword = $("#repeat-password-insert").val();

    if(repeatPassword == ""){
        errorsArray.push("Repeat password is a required field.");
    }
    else if(repeatPassword!=password){
        errorsArray.push("Repeat password field does not match with your password.");
    }

    var email = $("#email-insert").val();
    var emailReg = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;

    if(email != ""){
        if(!emailReg.test(email)){
            errorsArray.push("Your email is not in correct format.");
        }
    }

    if(!errorsArray.length){
        validation = true;
    }
    else{
        validation = false;
        console.log("uslo u if koji ima greske");
        let errorsList = "<ul>";

        for(let i = 0; i < errorsArray.length; i++){
            errorsList += `<li>${errorsArray[i]}</li>`;
        }
        errorsList += "</ul><p class='admin_ok'><a id='closeMessage' href=''>OK</a></p>";
        $("#message").show();
        $("#message").html(errorsList);
        $("#closeMessage").click(closeMessage);
        $('html,body').animate({scrollTop: 9999});

    }
    return validation;
}
function checkUser() {
    $.ajax({
        url: "user/check-user",
        success: function (user) {
            console.log("user check" + user);
            sessionStorage.setItem("check", user);
        }
    });
}
function showSocks(socksArray){
    console.log(socksArray);
   var socks = socksArray[0];
   console.log(socks);
   var socksLength = socksArray[1];
   var countProducts = socksArray[1] * 12;
   if(countProducts == 1){
        $("#count-paragraph").text(countProducts + " product");
    }
   else {
        $("#count-paragraph").text(countProducts + " products");
   }
    console.log("carape su " +socks);
    console.log(countProducts);
    var html = "";
    for(let sock in socks) {
        html += `
        <div class="sock" data-id="">
    <div class="sock-wrapper" data-mainimage="${socks[sock].id}">
        <img src="${urlImg}/${socks[sock].big_image}" alt=""/>
    </div>`;
        var id = socks[sock].id_sock;
        console.log(id);
        html+=`<div class="small-pictures flex-element" id="small-pictures-${id}"></div>`;

        $.ajax({
            url: "socks/smallImages/"+id,
            method: "get",
            dataType: "json",
            success: function(smallPictures){
                console.log(smallPictures);
                showSmallSocks(smallPictures);
            },
            error(xhr, status, error){
                console.log(xhr.status);
                console.log(error);
            }
        });

        function showSmallSocks(smallPictures){
            var small = "";
            for (let smallPicture in smallPictures) {
                small += `
            <div class="image-circle">
                <a href="#" data-id="${smallPictures[smallPicture].id}" id="sock${smallPictures[smallPicture].id}" class="small-image-link"><img src="${urlImg}/${smallPictures[smallPicture].small_image}" alt=""/></a>
            </div> `;
                var Id = smallPictures[smallPicture].sock_id;
            }
            $("#small-pictures-"+Id).html(small);
            $(".small-image-link").hover(
                function(){
                    //mouseover small image
                    let id = $(this).data("id");
                    let linkId = $(this).attr("id");
                    getBigSock(id, linkId);
                },
                function(){
                    //mouse out small image
                    let linkId = $(this).attr("id");
                    let  id = $(this).parent().parent().prev().data("mainimage");
                    getBigSock(id, linkId);
                }
            );
        }
        html += `
    <h3>${socks[sock].sock_name}</h3>
    <p>`
        let oldPrice = socks[sock].price;
        oldPrice = Math.round(oldPrice);
        if(socks[sock].discount > 0) {
            let price = socks[sock].price - (socks[sock].discount / 100 * socks[sock].price);
            price = Math.round(price);
            html += `${price}&#36;<i id="old-price">${oldPrice}</i>`;
        }
        else{
            html += `${oldPrice}&#36;` }
        html += `</p>`;
        let check = sessionStorage.getItem("check");
        console.log("Check: " +check);
        if(check == 1) {
            html += `<span class="span-cart"><i class="fa fa-shopping-cart"></i><a data-mother="${socks[sock].id_sock}" href="#" class="add-to-cart">Add to Cart</a></span>`;
        }
        html += `</div>  `;
    }
    $("#socks").html(html);
    pagHtml = "<ul class='flex-element'>";
    for(let i = 0; i < socksLength; i++){
        pagHtml += ` <li>
                        <a href="#"  id = "link${i}" data-limit="${i}" class="socks_pagination">${i+1}</a>
                    </li>`;
    }
   pagHtml += "</ul>";
    $("#pagination-block").html(pagHtml);
    let linkId = sessionStorage.getItem("linkId");
   $("#pagination-block ul li #"+linkId).addClass("active");
    $(".socks_pagination").click(sendLimit);
    $(".add-to-cart").click(showAddToCartDiv);
    if(!socksLength){
        $("#socks").html("No products found");
    }
}
function sortByDate() {
    $("#pagination-block ul li a").removeClass("active");
    $("#pagination-block ul li #link0").addClass("active");
    let sortActivity = $(this).val();
    sessionStorage.setItem("sortActivity", sortActivity);
    $.ajax({
        url: "activity/nextpage",
        method: "get",
        dataType: "json",
        data: {
            limit: 0,
            sortActivity: sortActivity
        },
        success: function(data){
            showActivities(data)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function sendLimitActivity(e) {
    e.preventDefault();
    let sort = sessionStorage.getItem("sortActivity");
    if(sort == null) {
        sort = 0;
    }
    console.log(sort);
    $("#pagination-block ul li a").removeClass("active");
    $(this).addClass("active");
    let limit = $(this).data("limit");
    console.log("Limit: " +limit);
    var link_id = $(this).attr("id");
    console.log("Link id: " +link_id);
    sessionStorage.setItem("linkId", ""+link_id);
    let linkId = sessionStorage.getItem("linkId");
    $.ajax({
        url: "activity/nextpage",
        method: "get",
        dataType: "json",
        data: {
            limit: limit,
            sortActivity: sort
        },
        success: function(data){
            showActivities(data)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });
}
function showActivities(data) {
    let html = `<tr>
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
        </tr>`;
    for(let a of data){
        html += `<tr>
                <td>
                    ${a.userId}
                </td>
                <td>
                    ${a.username}
                </td>
                <td>${a.activity}</td>
                <td>${a.ip_address}</td>
                <td>${a.date}</td>
            </tr>`;
    }
    $("#users-activity-table").html(html);
}
function sendLimit(e){
    let searchParam = $("#shop-search-socks").val();
    if(searchParam == ""){
        searchParam = 0;
    }
    console.log("Sarch param: "+searchParam);
    let gender = sessionStorage.getItem("gender");
    if(gender == null){
        gender = 0;
    }
    console.log("Gender: " + gender);
    let color = sessionStorage.getItem("color");
    if(color == null){
        color = 0;
    }
    let sort = sessionStorage.getItem("sort");
    if(sort == null) {
        sort = 0;
    }
    console.log("sort je: " +sort);
    console.log("Color: " +color);
    $("#pagination-block ul li a").removeClass("active");
    $(this).addClass("active");
    e.preventDefault();
    let limit = $(this).data("limit");
    console.log("Limit: " +limit);
    var link_id = $(this).attr("id");
    console.log("Link id: " +link_id);
    sessionStorage.setItem("linkId", ""+link_id);
    let linkId = sessionStorage.getItem("linkId");
    $.ajax({
        url: "socks",
        method: "get",
        dataType: "json",
        data: {
            limit: limit,
            searchValue: searchParam,
            gender: gender,
            colorId: color,
            sortPrice: sort
        },
        success: function(socks){
            showSocks(socks)
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }
    });

}
function getBigSock(id, linkId){
    console.log(id);
    $.ajax({
        url: "socks/bigImage"+id,
        method: "get",
        dataType: "json",
        success: function(obj){
            let sockImage = obj.bigImage.image;
            console.log(sockImage);
            loadBigSock(linkId, sockImage);
        },
        error: function(xhr, status, error){
            console.warn(xhr.responseText);
        }

    });
}
function loadBigSock(linkId, image){
    console.log("moja prom: "+urlImg);
    $(".image-circle #" +linkId).parent().parent().prev().find("img").attr("src", ""+urlImg + "/"+image);
}
function getSearchText(){
    let searchField = $("#search-socks-field").val();
    console.log(searchField);
}
function hideRegistrationForm(e){
    e.preventDefault();
    $("#registration-form").hide();
}
function showLoginForm(e){
    e.preventDefault();
    $("#registration-form").show();
}
function login(){
    var errorsArray = [];
    let validation = false;
    var username = $("#username_login").val();
    var usernameReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(username == ""){
        errorsArray.push("Username is a required field.");
    }
    else if(!usernameReg.test(username)){
        errorsArray.push("The username must contain only lowercase letters and numbers,at least 8 characters long.");
    }

    var password = $("#password_login").val();
    var passwordReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(password== ""){
        errorsArray.push("Password is a required field.");
    }
    else if(!passwordReg.test(password)){
        errorsArray.push("Password must contain only lowercase letters and numbers, at least 8 characters long.");
    }

    if(!errorsArray.length){
        console.log("uslo u if kad je sve ok");
        validation = true;
    }
    else{
        console.log("uslo u if koji ima greske");
        let errorsList = "<ul>";
        validation = false;
        for(let i = 0; i < errorsArray.length; i++){
            errorsList += `<li>${errorsArray[i]}</li>`;
        }
        errorsList += "</ul>";
        $("#errors_div").html(errorsList);
        $("#errors_div").show();
        $('html,body').animate({scrollTop: 9999});

    }
    return validation;
}


function signUp(){
    var validation = 0;
    var errorsArray = [];

    var firstName = $("#first_name").val();
    var firstNameReg = /^[A-ZŠĐŽČĆŽ][a-zšđžčćž]{2,13}(\s[A-ZŠĐŽČĆ][a-zšđžčć]{2,13})*$/;

    if(firstName == ""){
        errorsArray.push("First name is a required field.");
    }
    else if(!firstNameReg.test(firstName)){
        errorsArray.push("First name must contain only letters and must start with upperkey.");
    }

    var lastName = $("#last_name").val();
    var lastNameReg = /^[A-ZŠĐŽČĆ][a-žćčžš]{2,13}(\s[A-ZŠĐŽČĆ][a-žćčžš]{2,13})*$/;

    if(lastName == ""){
        errorsArray.push("Last name is a required field.");
    }
    else if(!lastNameReg.test(lastName)){
        errorsArray.push("Last name must contain only letters and must start with upperkey.");
    }

    var username = $("#username_signup").val();
    var usernameReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(username == ""){
        errorsArray.push("Username is a required field.");
    }
    else if(!usernameReg.test(username)){
        errorsArray.push("The username must contain only lowercase letters and numbers,at least 8 characters long.");
    }

    var password = $("#password_signup").val();
    var passwordReg = /(?=.*[a-z])(?=.*[0-9])(?=.{8,})/;

    if(password== ""){
        errorsArray.push("Password is a required field.");
    }
    else if(!passwordReg.test(password)){
        errorsArray.push("Password must contain only lowercase letters and numbers, at least 8 characters long.");
    }

    var repeatPassword = $("#repeat_password").val();

    if(repeatPassword == ""){
        errorsArray.push("Repeat password is a required field.");
    }
    else if(repeatPassword!=password){
        errorsArray.push("Repeat password field does not match with your password.");
    }

    var email = $("#user_email").val();
    var emailReg = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;

    if(email != ""){
        if(!emailReg.test(email)){
            errorsArray.push("Your email is not in correct format.");
        }
    }

    if(!errorsArray.length){
        validation = true;
    }
    else{
        validation = false;
        console.log("uslo u if koji ima greske");
        let errorsList = "<ul>";

        for(let i = 0; i < errorsArray.length; i++){
            errorsList += `<li>${errorsArray[i]}</li>`;
        }
        errorsList += "</ul>";
        $("#errors_div").html(errorsList);
        $("#errors_div").show();
        $("#message").html(errorsList);
        $("#errors_div").show();
        $('html,body').animate({scrollTop: 9999});

    }
    return validation;

}

