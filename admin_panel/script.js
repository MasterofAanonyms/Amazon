function changeView() {
  let signInBox = document.getElementById("signIn_Box");
  let singUpBox = document.getElementById("signUp_Box");

  signInBox.classList.toggle("d-none");
  singUpBox.classList.toggle("d-none");
}

function signUp() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let email = document.getElementById("email");
  let mobile = document.getElementById("mobile");
  let username = document.getElementById("username");
  let password = document.getElementById("password");

  // alert(fname.value);

  let f = new FormData();
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("e", email.value);
  f.append("m", mobile.value);
  f.append("u", username.value);
  f.append("p", password.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let response = request.responseText;
      // alert(response);
      if (response == "Success") {
        document.getElementById("msg1").innerHTML =
          "Registration Successfully.";
        document.getElementById("msg1").className = "alert alert-success";
        document.getElementById("msgDiv1").className = "d-block";

        fname.value = "";
        lname.value = "";
        email.value = "";
        mobile.value = "";
        username.value = "";
        password.value = "";
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgDiv1").className = "d-block";
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(f);
}

function SignIn() {
  let un = document.getElementById("un");
  let pw = document.getElementById("pw");
  let rm = document.getElementById("rm");

  // alert("ok");

  let f = new FormData();
  f.append("u", un.value);
  f.append("p", pw.value);
  f.append("r", rm.checked);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let response = request.responseText;
      // alert(response);
      if (response == "Success") {
        window.location = "index.php";
      } else {
        document.getElementById("msg2").innerHTML = response;
        document.getElementById("msgDiv2").className = "d-block";
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(f);
}

function adminSignIn() {
  let un = document.getElementById("un");
  let pw = document.getElementById("pw");

  // alert(un.value);

  let f = new FormData();
  f.append("u", un.value);
  f.append("p", pw.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let response = request.responseText;
      // alert(response);

      if (response == "Success") {
        window.location = "adminDashboard.php";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgDiv").classList = "d-block";
      }
    }
  };

  request.open("POST", "adminSignInProcess.php", true);
  request.send(f);
}

function loadUser() {
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let response = request.responseText;
      // alert(response);
      document.getElementById("tb").innerHTML = response;
    }
  };

  request.open("POST", "loadUserProcess.php", true);
  request.send();
}

function updateUserStatus() {
  let userid = document.getElementById("uid");
  // alert(userid.value);

  let f = new FormData();
  f.append("u", userid.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let response = request.responseText;
      // alert(response);
      if (response == "Deactive") {
        document.getElementById("msg").innerHTML =
          "User Deactivate Successful.";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgDiv").className = "d-block";
        userid.value = "";
        loadUser();
      } else if (response == "Active") {
        document.getElementById("msg").innerHTML = "User Activate Successful.";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgDiv").className = "d-block";
        userid.value = "";
        loadUser();
      } else {
        //Other responce
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgDiv").className = "d-block";
      }
    }
  };

  request.open("POST", "updateUserStatusProcess.php", true);
  request.send(f);
}

function reload() {
  location.reload();
}

function regProduct() {
  let pname = document.getElementById("pname");
  let brand = document.getElementById("brand");
  let cat = document.getElementById("cat");
  let color = document.getElementById("color");
  let size = document.getElementById("size");
  let desc = document.getElementById("desc");
  let file = document.getElementById("file");

  let form = new FormData();
  form.append("pname", pname.value);
  form.append("brand", brand.value);
  form.append("cat", cat.value);
  form.append("color", color.value);
  form.append("size", size.value);
  form.append("desc", desc.value);
  form.append("image", file.files[0]);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let responce = request.responseText;
      alert(responce);
    }
  };

  request.open("POST", "regProductProcess.php", true);
  request.send(form);
}

function updateStock() {
  // alert("ok");

  let pname = document.getElementById("selectProduct");
  let qty = document.getElementById("qty");
  let uprice = document.getElementById("uprice");

  // alert(pname.value);

  let f = new FormData();
  f.append("p", pname.value);
  f.append("q", qty.value);
  f.append("up", uprice.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.readyState == 4) & (request.status == 200)) {
      let responce = request.responseText;
      alert(responce);
      location.reload();
    }
  };

  request.open("POST", "updateStockProcess.php", true);
  request.send(f);
}

function printDiv() {
  // alert("ok");

  let originalContent = document.body.innerHTML;
  let printArea = document.getElementById("printArea").innerHTML;

  document.body.innerHTML = printArea;

  window.print();

  document.body.innerHTML = originalContent;
}

function loadProduct(x) {
  let page = x;
  // alert(x);

  let f = new FormData();
  f.append("p", page);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      document.getElementById("pid").innerHTML = responce;
    }
  };

  request.open("POST", "loadProductProcess.php", true);
  request.send(f);
}

function searchProduct(x) {
  let page = x;
  let product = document.getElementById("product");

  // alert(page);
  // alert(product.value);

  let f = new FormData();
  f.append("p", product.value);
  f.append("pg", page);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      document.getElementById("pid").innerHTML = responce;
    }
  };

  request.open("POST", "searchProductProcess.php", true);
  request.send(f);
}

function viewFilter() {
  document.getElementById("filterId").className = "d-block";
}

function advSearchProduct(x) {
  // alert("ok");

  let page = x;
  let color = document.getElementById("color");
  let cat = document.getElementById("cat");
  let brand = document.getElementById("brand");
  let size = document.getElementById("size");
  let min = document.getElementById("min");
  let max = document.getElementById("max");

  // alert(cat.value);

  let f = new FormData();
  f.append("pg", page);
  f.append("co", color.value);
  f.append("cat", cat.value);
  f.append("b", brand.value);
  f.append("s", size.value);
  f.append("min", min.value);
  f.append("max", max.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      document.getElementById("pid").innerHTML = responce;
    }
  };

  request.open("POST", "advSearchProductProcess.php", true);
  request.send(f);
}

function uploadImg() {
  let img = document.getElementById("imageUploader");

  let f = new FormData();
  f.append("i", img.files[0]);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);

      if (responce == "empty") {
        alert("Please select your profile image.");
      } else {
        document.getElementById("i").src = responce;
        img.value = "";
      }
    }
  };

  request.open("POST", "profileImgUpload.php", true);
  request.send(f);
}

function updateData() {
  let fname = document.getElementById("fname");
  let lname = document.getElementById("lname");
  let email = document.getElementById("email");
  let mobile = document.getElementById("mobile");
  let password = document.getElementById("password");
  let no = document.getElementById("no");
  let line1 = document.getElementById("line1");
  let line2 = document.getElementById("line2");

  // alert(fname.value);

  let f = new FormData();
  f.append("f", fname.value);
  f.append("l", lname.value);
  f.append("e", email.value);
  f.append("m", mobile.value);
  f.append("pw", password.value);
  f.append("no", no.value);
  f.append("l1", line1.value);
  f.append("l2", line2.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      alert(responce);
      reload();
    }
  };

  request.open("POST", "updateDataProcess.php", true);
  request.send(f);
}

function signOut() {
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      alert(responce);
      reload();
    }
  };

  request.open("POST", "signOutProcess.php", true);
  request.send();
}

function addCart(x) {
  let stockId = x;
  let qty = document.getElementById("qty");

  if (qty.value > 0) {
    let f = new FormData();
    f.append("s", stockId);
    f.append("q", qty.value);

    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        // alert(responce);
        swal("Good job!", responce, "success");
        qty.value = "";
      }
    };

    request.open("POST", "addtoCartProcess.php", true);
    request.send(f);
  } else {
    alert("Please enter valid quantity.");
  }
}

function loadCart() {
  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      document.getElementById("cartBody").innerHTML = responce;
    }
  };

  request.open("POST", "loadCartprocess.php", true);
  request.send();
}

function incrementQty(x) {
  let cartId = x;
  let qty = document.getElementById("qty" + x);
  let newQty = parseInt(qty.value) + 1;
  // alert(newQty);

  let f = new FormData();
  f.append("c", cartId);
  f.append("q", newQty);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      if (responce == "Success") {
        qty.value = parseInt(qty.value) + 1;
        loadCart();
      } else {
        alert(responce);
      }
    }
  };

  request.open("POST", "updateCartQtyProcess.php", true);
  request.send(f);
}

function decrementQty(x) {
  let cartId = x;
  let qty = document.getElementById("qty" + x);
  let newQty = parseInt(qty.value) - 1;
  // alert(newQty);

  let f = new FormData();
  f.append("c", cartId);
  f.append("q", newQty);

  if (newQty > 0) {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        // alert(responce);
        if (responce == "Success") {
          qty.value = parseInt(qty.value) - 1;
          loadCart();
        } else {
          alert(responce);
        }
      }
    };

    request.open("POST", "updateCartQtyProcess.php", true);
    request.send(f);
  }
}

function removeCart(x) {
  if (confirm("Are you sure deleting this item")) {
    let f = new FormData();
    f.append("c", x);

    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        alert(responce);
        reload();
      }
    };

    request.open("POST", "removeCartProcess.php", true);
    request.send(f);
  }
}

function checkOut() {
  // alert("ok");

  let f = new FormData();
  f.append("cart", true);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      let payment = JSON.parse(responce);
      doCheckout(payment, "checkoutProcess.php");
    }
  };

  request.open("POST", "paymentProcess.php", true);
  request.send(f);
}

function doCheckout(payment, path) {
  // Payment completed. It can be a successful failure.
  payhere.onCompleted = function onCompleted(orderId) {
    console.log("Payment completed. OrderID:" + orderId);
    // Note: validate the payment and show success or failure page to the customer

    let f = new FormData();
    f.append("payment", JSON.stringify(payment));

    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        // alert(responce);
        let order = JSON.parse(responce);

        if (order.resp == "Success") {
          // reload();
          window.location = "invoice.php?orderId=" + order.order_id;
        } else {
          alert(responce);
        }
      }
    };

    request.open("POST", path, true);
    request.send(f);
  };

  // Payment window closed
  payhere.onDismissed = function onDismissed() {
    // Note: Prompt user to pay again or show an error page
    console.log("Payment dismissed");
  };

  // Error occurred
  payhere.onError = function onError(error) {
    // Note: show an error page
    console.log("Error:" + error);
  };

  // Show the payhere.js popup, when "PayHere Pay" is clicked
  // document.getElementById('payhere-payment').onclick = function (e) {
  payhere.startPayment(payment);
  // };
}

function buyNow(stockId) {
  // alert(stockId);
  let qty = document.getElementById("qty");

  if (qty.value > 0) {
    let f = new FormData();
    f.append("cart", false);
    f.append("stockId", stockId);
    f.append("qty", qty.value);

    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        // alert(responce);
        let payment = JSON.parse(responce);
        payment.stock_id = stockId;
        payment.qty = qty.value;
        doCheckout(payment, "buynowProcess.php");
      }
    };

    request.open("POST", "paymentProcess.php", true);
    request.send(f);
  } else {
    alert("Please enter valid quantity");
  }
}

function forgetPassword() {
  let email = document.getElementById("email");

  if (email.value != "") {
    let f = new FormData();
    f.append("e", email.value);

    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let responce = request.responseText;
        // alert(responce);

        if (responce == "success") {
          document.getElementById("msg2").innerHTML ="Email sent! Please check your mail box";
          document.getElementById("msgDiv2").className = "alert alert-success";
          document.getElementById("msgDiv2").className = "d-block";
        } else {
          document.getElementById("msg2").innerHTML = responce;
          document.getElementById("msgDiv2").className = "alert alert-danger";
          document.getElementById("msgDiv2").className = "d-block";
        }
      }
    };

    request.open("POST", "forgetPasswordProcess.php", true);
    request.send(f);
  } else {
    alert("Please enter your password");
  }
}

function resetPassword() {
  let vcode = document.getElementById("vcode");
  let np = document.getElementById("np1");
  let np2 = document.getElementById("np2");

  let f = new FormData();
  f.append("vcode", vcode.value);
  f.append("np", np.value);
  f.append("np2", np2.value);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let responce = request.responseText;
      // alert(responce);
      if (responce == "Success") {
        window.location = "signIn.php";
      } else {
        document.getElementById("msg2").innerHTML = responce;
        document.getElementById("msgDiv2").className = "alert alert-danger";
        document.getElementById("msgDiv2").className = "d-block";
      }
    }
  };

  request.open("POST", "resetPasswordProcess.php", true);
  request.send(f);
}

function sell_signout() {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        window.location.href = "seller_login.php";
      }
    }
  };

  request.open("GET", "sell_signOutProcess.php", true);
  request.send();
}

function admin_signout() {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        window.location.href = "../admin_signin.php";
      }
    }
  };

  request.open("GET", "admin_Signout.php", true);
  request.send();
}

function deactive(email) {
  alert("hi")
  // let request = new XMLHttpRequest();

  // request.onreadystatechange = function () {
  //   if ((request.status == 200) & (request.readyState == 4)) {
  //     let response = request.responseText;
  //     alert(response);
  //     window.location.reload();
  //   }
  // };

  // request.open("GET", "deactive.php?id=" + email, true);
  // request.send();
}

function p_active(id) {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
      window.location.reload();
    }
  };

  request.open("GET", "active_productProcess.php?id=" + id, true);
  request.send();
}

function addbrand() {
  let brand = document.getElementById("Bname");
  let category2 = document.getElementById("category2");

  let form = new FormData();

  form.append("B", brand.value);
  form.append("C2", category2.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
    }
  };
  request.open("POST", "addbrand.php", true);
  request.send(form);
}

function addmodel() {
  let model = document.getElementById("Mname");
  let bradn2 = document.getElementById("bradn2");

  let form = new FormData();

  form.append("M", model.value);
  form.append("B", bradn2.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
    }
  };
  request.open("POST", "addmodel.php", true);
  request.send(form);
}

function adddiscount() {
  let discount = document.getElementById("Dname");

  let form = new FormData();

  form.append("D", discount.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
    }
  };
  request.open("POST", "adddiscount.php", true);
  request.send(form);
}

function addcolor() {
  let color = document.getElementById("Cname");

  let form = new FormData();

  form.append("C", color.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
    }
  };
  request.open("POST", "addcolor.php", true);
  request.send(form);
}

function updatestatus(id){
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
          let response = request.responseText;
          if (response == "update") {
              window.location.reload();
          } else {
              alert(response);
          }
      }
  }

  request.open("GET", "../updateInvoiceStatus.php?id=" + id, true);
  request.send();
}