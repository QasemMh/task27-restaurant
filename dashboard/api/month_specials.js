$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task27_1/api/month_special?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
          <th>id</th>
          <th>title</th>
          <th>sub title</th>
          <th>price</th>
          <th>Action</th>
          </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
        <td>${i++}</td>
        <td>${item.title}</td>
        <td>${item.sub_title}</td>
        <td>${item.price}</td>
          <td><button class="btn btn-sm btn-info update_item" data-id=${
            item.id
          }>Edit</button>
         <button class="btn btn-sm btn-danger delete_item" data-id=${
           item.id
         }>Delete</button>
        <button class="btn btn-sm btn-secondary view_item" data-id=${
          item.id
        }>View</button>
        </td>
        </tr>`;
        }

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("month_special", "month_special Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //view
  $(document).on("click", ".view_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task27_1/api/month_special/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
          <div class="row">
          <div class="col-md-8 overflow-hidden m-auto">
          <img src="http://localhost:81/task27_1/image/${data.path}" class="img-fluid" alt="month_special image">  
          </div>
  
         <div class="col-md-12 mt-4">
      
          <dl class="row">
  
          <dt class="col-sm-3 text-left">title</dt>
          <dd class="col-sm-9 text-left">${data.title}</dd>
  
          <dt class="col-sm-3 text-left">sub title</dt>
          <dd class="col-sm-9 text-left">${data.sub_title}</dd>
  
          <dt class="col-sm-3 text-left">price</dt>
          <dd class="col-sm-9 text-left">${data.price}</dd>
  
          </dl> 
          </div>
          </div> 
          
            <!--item-->
            <div class="form-group w-50">
             <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
            </div>
          `;

        $("#app .card-body").html(view_item);
        changePageTitle("View Message");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //Create
  // show html form when 'create item' button was clicked
  $(document).on("click", "#create_item", function () {
    let category_list = "";
    let users_list = "";

    /*html*/
    let create_form = `
              <form action="" method="POST" id="create_form" enctype="multipart/form-data">
              <div class="form-group">
              <label>Title</label>
              <input  type='text' name='title' class='form-control' required/>
              </div>
              <!--item-->
              <div class="form-group">
              <label>sub Title</label>
              <input  type='text' name='sub_title' class='form-control' required/>
              </div>
              <!--item-->
              <div class="form-group">
              <label>Price</label>
              <input  type='number' min="0" name='price' class='form-control' required/>
              </div>
              <!--item-->
              <div class="input-group mb-3 w-50">
              <div class="custom-file">
                <input type="file" name="path" class="custom-file-input" id="inputGroupFile01" required accept="image/*">
                <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
              </div>
            </div>
              <!--item-->
              <div class="form-group w-50">
              <button  type='submit' class="btn btn-primary" >Submit</button>
              <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
              </div>
              <!--item-->
              </form>`;

    $("#app .card-body").html(create_form);
    changePageTitle("Create month_special");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");
    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='file']").forEach((element) => {
      formData.append(element.name, element.files[0]);
    });
    form.querySelectorAll("input[type='number']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    // Send data to backend
    fetch("http://localhost:81/task27_1/api/month_special/create", {
      method: "POST",
      body: formData,
    }).then((res) => {
      if (res.ok) {
        //show all month_special
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'Update month_special ' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let month_specialUri =
      "http://localhost:81/task27_1/api/month_special/details/" + id;

    fetch(month_specialUri)
      .then((res) => res.json())
      .then((data) => {
        //generate create form for month_special:
        /*html*/
        let update_form = `
      <form action="" method="POST" id="update_form" enctype="multipart/form-data">
      <input type="hidden" value="${data.id}" name="id">
  
      <div class="form-group">
      <label>Title</label>
      <input  type='text' value="${data.title}"  name='title' class='form-control' required/>
      </div>
         <!--item-->
         <div class="form-group">
         <label>sub Title</label>
         <input  type='text' name='sub_title' value="${data.sub_title}" class='form-control' required/>
         </div>
         <!--item-->
         <div class="form-group">
         <label>Price</label>
         <input  type='number' min="0" name='price' value="${data.price}" class='form-control' required/>
         </div>
      <!--item-->
      <div class="input-group mb-3 w-50">
      <input type="hidden" value="${data.path}" name="path2">
      <div class="custom-file">
        <input type="file" name="path" class="custom-file-input" id="inputGroupFile01" accept="image/*">
        <label class="custom-file-label" for="inputGroupFile01">Update Image?</label>
      </div>
    </div>
      <!--item-->
      <div class="form-group w-50">
      <button  type='submit' class="btn btn-primary" >Save</button>
      <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
      </div>
      <!--item-->
      </form>`;

        $("#app .card-body").html(update_form);
        changePageTitle("Update month_special");

        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //end update form
  // 'update month_special form' submit handle will be here
  // will run if create user form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");
    let formData = new FormData();

    form.querySelectorAll("input[type='text']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='hidden']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='number']").forEach((element) => {
      formData.append(element.name, element.value);
    });
    form.querySelectorAll("input[type='file']").forEach((element) => {
      if (element.value) {
        formData.append(element.name, element.files[0]);
      }
    });

    // Send data to backend
    fetch(
      "http://localhost:81/task27_1/api/month_special/update/" +
        formData.get("id"),
      {
        method: "POST",
        body: formData,
      }
    ).then((res) => {
      if (res.ok) {
        //show all month_special
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end update

  //delete
  // will run if the delete button was clicked
  $(document).on("click", ".delete_item", function () {
    let id = $(this).attr("data-id");
    // alert
    Swal.fire({
      title: "Do you want to Delete this?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("http://localhost:81/task27_1/api/month_special/delete/" + id, {
          method: "POST",
        })
          .then((respon) => {
            $(this).parents("tr").fadeOut();
            Swal.fire("Deleted!", "", "success");
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "Oops... " + error,
              text: "Something went wrong!",
            });
          });
      }
    });
  });
});
