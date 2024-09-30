// seller dashboard
document.addEventListener("DOMContentLoaded", function (event) {
  const showNavbar = (toggleId, navId, bodyId, headerId) => {
    const toggle = document.getElementById(toggleId),
      nav = document.getElementById(navId),
      bodypd = document.getElementById(bodyId),
      headerpd = document.getElementById(headerId);

    // Validate that all letiables exist
    if (toggle && nav && bodypd && headerpd) {
      toggle.addEventListener("click", () => {
        // show navbar
        nav.classList.toggle("show");
        // change icon
        toggle.classList.toggle("bx-x");
        // add padding to body
        bodypd.classList.toggle("body-pd");
        // add padding to header
        headerpd.classList.toggle("body-pd");
      });
    }
  };

  showNavbar("header-toggle", "nav-bar", "body-pd", "header");

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll(".nav_link");

  function colorLink() {
    if (linkColor) {
      linkColor.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");
    }
  }
  linkColor.forEach((l) => l.addEventListener("click", colorLink));

  // Your code to run since DOM is loaded and ready
});

function signup() {
  let uname = document.getElementById("uname");
  let pw = document.getElementById("password");
  let mobile = document.getElementById("mobile");
  let email = document.getElementById("email");
  let gen = document.getElementById("gender");

  let form = new FormData();
  form.append("un", uname.value);
  form.append("pw", pw.value);
  form.append("m", mobile.value);
  form.append("e", email.value);
  form.append("g", gen.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;

      if (response == "success") {
        alert("Account created successfully.");
        window.location = "login.php";
      } else if (response == "allready") {
        alert(
          "Your email or phone number allready registred! Please try login."
        );
        window.location = "login.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "signupProcess.php", true);
  request.send(form);
}

function signin() {
  let email = document.getElementById("email2");
  let password = document.getElementById("password2");
  let rememberme = document.getElementById("rememberme");

  let form = new FormData();
  form.append("e", email.value);
  form.append("pw", password.value);
  form.append("rm", rememberme.checked);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        alert("you successfully signed");
        window.location.href = "index.php";
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

let forgotPasswordModal;

function forgotPassword() {
  let anchor = document.getElementById("myAnchor");
  anchor.classList.add("disabled-link"); 
             
  let email = document.getElementById("email2");

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let text = request.responseText;

      if (text == "Success") {
        alert(
          "Verification code has sent successfully. Please check your Email."
        );
        let modal = document.getElementById("fpmodal");
        forgotPasswordModal = new bootstrap.Modal(modal);
        forgotPasswordModal.show();
      } else {
        alert(text);
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();
}

function showPassword1() {
  let textfield = document.getElementById("np");
  let button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}

function showPassword2() {
  let textfield = document.getElementById("rnp");
  let button = document.getElementById("rnpb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}

function resetPassword() {
  let email = document.getElementById("email2");
  let newPassword = document.getElementById("np");
  let retypePassword = document.getElementById("rnp");
  let verification = document.getElementById("vcode");

  let form = new FormData();
  form.append("e", email.value);
  form.append("n", newPassword.value);
  form.append("r", retypePassword.value);
  form.append("v", verification.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        alert("Password updated successfully.");
        forgotPasswordModal.hide();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "resetPasswordProcess.php", true);
  request.send(form);
}

function signout() {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        window.location.reload();
      }
    }
  };

  request.open("GET", "signOutProcess.php", true);
  request.send();
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
//

function changeProfileImg() {
  let img = document.getElementById("profileimage");

  img.onchange = function () {
    let file = this.files[0];
    let url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  };
}

function updateProfile() {
  let uname = document.getElementById("uname");
  let mobile = document.getElementById("mobile");
  let line1 = document.getElementById("line1");
  let line2 = document.getElementById("line2");
  let province = document.getElementById("province");
  let district = document.getElementById("district");
  let city = document.getElementById("city");
  let pcode = document.getElementById("pcode");
  let image = document.getElementById("profileimage");

  let form = new FormData();

  form.append("n", uname.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);
  form.append("i", image.files[0]);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;

      if (response == "success") {
        alert("Profile updated successfully.");
        window.location = "index.php";
      } else {
        alert(response);
        window.location.reload();
      }
    }
  };

  request.open("POST", "updateProfileProcess.php", true);
  request.send(form);
}

function sellerRegistor() {
  let uname = document.getElementById("uname");
  let pw = document.getElementById("password");
  let mobile = document.getElementById("phone");
  let email = document.getElementById("email");
  let gen = document.getElementById("gender");
  let agreement = document.getElementById("flexCheckDefault");

  let form = new FormData();
  form.append("un", uname.value);
  form.append("pw", pw.value);
  form.append("m", mobile.value);
  form.append("e", email.value);
  form.append("g", gen.value);
  form.append("ag", agreement.checked);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        alert("Account created successfully. Please login.");
        window.location = "seller_login.php";
      } else if (response == "allready") {
        alert(
          "Your email or phone number allready registred! Please try Login"
        );
        window.location = "seller_login.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "sellersignupProcess.php", true);
  request.send(form);
}

function sellerLogin() {
  let email = document.getElementById("email2");
  let pw = document.getElementById("password");
  let rem = document.getElementById("rememberMe");

  let form = new FormData();
  form.append("e", email.value);
  form.append("pw", pw.value);
  form.append("rem", rem.checked);

  let request = new XMLHttpRequest();
  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "success") {
        alert("Login successfully.");
        window.location = "seller_dashboard.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "sellerLoginProcess.php", true);
  request.send(form);
}

let av;
function adminVerification() {

  var button = document.getElementById("myButton");
            button.disabled = true; // Disable the button
            button.classList.add("btn-lg", "btn-primary"); // Ensure button keeps Bootstrap styles

  let email = document.getElementById("e");

  let form = new FormData();
  form.append("e", email.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          if (response == "Success") {
              alert("Please take a look at your email to find the VERIFICATION CODE.");
              let adminVerificationModal = document.getElementById("verificationModal");
              av = new bootstrap.Modal(adminVerificationModal);
              av.show();
          } else {
              alert(response);
          }

      }
  }

  request.open("POST", "adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {

  let code = document.getElementById("vcode");

  let form = new FormData();
  form.append("c", code.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          if (response == "success") {
              av.hide();
              window.location.href = 'admin_panel/adminDashboard.php';
          } else {
              alert(response);
          }

      }
  }

  request.open("POST", "verificationProcess.php", true);
  request.send(form);

}

function addProduct() {
  let product_name = document.getElementById("name");
  let price = document.getElementById("price");
  let qty = document.getElementById("qty");
  let dwc = document.getElementById("dwc");
  let doc = document.getElementById("doc");
  let category = document.getElementById("category");
  let brand = document.getElementById("brand");
  let model = document.getElementById("model");
  let color = document.getElementById("color");
  let discount = document.getElementById("discount");
  let condition = document.getElementById("condition");
  let dicription = document.getElementById("desc");
  let image = document.getElementById("imageuploader");

  let form = new FormData();

  form.append("n", product_name.value);
  form.append("p", price.value);
  form.append("q", qty.value);
  form.append("w", dwc.value);
  form.append("o", doc.value);
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("clr", color.value);
  form.append("d", discount.value);
  form.append("con", condition.value);
  form.append("disc", dicription.value);

  let file_count = image.files.length;

  for (let x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "OK") {
        alert("product added successfully.");
        location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "addProductProcess.php", true);
  request.send(form);
}

function changeProductImage() {
  let image = document.getElementById("imageuploader");

  image.onchange = function () {
    let file_count = image.files.length;

    if (file_count <= 3) {
      for (let x = 0; x < file_count; x++) {
        let file = this.files[x];
        let url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(
        file_count +
          " files. You are proceed to upload only 3 or less than 3 files."
      );
    }
  };
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
  request.open("POST", "addnewoptionsProcess.php", true);
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
  request.open("POST", "addnewoptionsProcess.php", true);
  request.send(form);
}

function sort1(x) {
  let search = document.getElementById("search");
  let time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  let form = new FormData();
  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("c", condition);
  form.append("page", x);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      document.getElementById("sort").innerHTML = response;
    }
  };

  request.open("POST", "sortProcess.php", true);
  request.send(form);
}

function clearSort() {
  window.location.reload();
}

function sort1(x) {
  let search = document.getElementById("search");
  let category = document.getElementById("categorys");
  let condition = document.getElementById("conditions");
  let time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  let qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  let form = new FormData();
  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("con", condition.value);
  form.append("cat", category.value);
  form.append("b", brand.value);
  form.append("col", color.value);
  form.append("con", condition.value);
  form.append("page", x);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      document.getElementById("sort").innerHTML = response;
    }
  };

  request.open("POST", "sortProcess.php", true);
  request.send(form);
}

function p_deactive(id) {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      alert(response);
      window.location.reload();
    }
  };

  request.open("GET", "disable_productProcess.php?id=" + id, true);
  request.send();
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

function sendid(id) {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;

      if (response == "Success") {
        window.location = "updateProduct.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "sendIdProcess.php?id=" + id, true);
  request.send();
}

function addToCart(id) {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;
      if (response == "change") {
        alert("Please Login or Signup first.");
        window.location.href = "login.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "addToCartProcess.php?id=" + id, true);
  request.send();
}

function buyNow(id) {
  let qty = document.getElementById("qty_input").value;

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      let response = request.responseText;

      let obj = JSON.parse(response);

      let mail = obj["umail"];
      let amount = obj["amount"];

      if (response == 1) {
        alert("Please Login.");
        window.location = "login.php";
      } else if (response == 2) {
        alert("Please update your profile.");
        window.location = "userProfile.php";
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          alert("Payment completed. OrderID:" + orderId);
          saveInvoice(orderId, id, mail, amount, qty);
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

        // Put the payment letiables here
        let payment = {
          "sandbox": true,
          "merchant_id": obj["mid"], // Replace your Merchant ID
          "return_url":
            "http://localhost:8080/vilet_pro(testing)/sdds.php?id=" + id, // Important
          "cancel_url":
            "http://localhost:8080/vilet_pro(testing)/sdds.php?id=" + id, // Important
          "notify_url": "http://sample.com/notify",
          "order_id": obj["id"],
          "items": obj["item"],
          "amount": obj["amount"] + ".00",
          "currency": "LKR",
          "hash": obj["hash"], // *Replace with generated hash retrieved from backend
          "first_name": obj["user_name"],
          "last_name": "",
          "email": mail,
          "phone": obj["mobile"],
          "address": obj["address"],
          "city": obj["city"],
          "country": "Sri Lanka",
          "delivery_address": obj["address"],
          "delivery_city": obj["city"],
          "delivery_country": "Sri Lanka",
          "custom_1": "",
          "custom_2": "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        document.getElementById('payhere-payment').onclick = function (e) {
          payhere.startPayment(payment);
      };
      }
    }
  };
  request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {

  let form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;

          if (response == "success") {
              window.location = "invoice.php?id=" + orderId;
          } else {
              alert(response);
          }
      }
  }

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);

}

document.getElementById('sendBtn');

function sendMessage() {
    const userInput = document.getElementById('userInput').value;
    if (userInput.trim() === '') return;

    appendMessage('user', userInput);
    document.getElementById('userInput').value = '';

    fetch('chat_process.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: userInput })
    })
    .then(response => response.json())
    .then(data => {
        appendMessage('bot', data.response);
    });
}

function appendMessage(sender, message) {
  const chatBody = document.getElementById('chat-body');
  const messageElement = document.createElement('div');
  messageElement.classList.add('message', sender);
  messageElement.textContent = message;
  chatBody.appendChild(messageElement);
  chatBody.scrollTop = chatBody.scrollHeight;
}



function printInvoice() {
  let restorePage = document.body.innerHTML;
  let page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

function updateProduct() {

  let product_name = document.getElementById("name");
  let qty = document.getElementById("qty");
  let dwc = document.getElementById("dwc");
  let doc = document.getElementById("doc");
  let description = document.getElementById("desc");
  let images = document.getElementById("imageuploader");

  let form = new FormData();
  form.append("pname", product_name.value);
  form.append("q", qty.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("d", description.value);

  let file_count = images.files.length;

  for (let x = 0; x < file_count; x++) {
      form.append("i" + x, images.files[x]);
  }

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          if (response == "Product has been Updated.Invalid Image Count.") {
              window.location = "seller_dashboard.php";
          } else {
              alert(response);
          }

      }
  }

  request.open("POST", "updateProductProcess.php", true);
  request.send(form);

}

function viewInvoice(id){
  window.location = "invoice.php?id=" + id;
}



function addToWatchlist(id) {
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;

          if (response == "added") {
              document.getElementById("heart" + id).style.className = "text-danger";
              window.location.reload();
          } else if (response == "removed") {
              document.getElementById("heart" + id).style.className = "text-dark";
              window.location.reload();
          } else {
              alert(response);
          }

      }
  }

  request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  request.send();

}

function changeQTY(id) {
  let qty = document.getElementById("qty_input").value;

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
          let response = request.responseText;
          if (response == "Updated") {
              window.location.reload();
          } else {
              alert(response);
          }
      }
  }

  request.open("GET", "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id, true);
  request.send();
}

function deleteFromCart(id) {

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          if (response == "Removed") {
              alert("Product removed from Cart.");
              window.location.reload();
          } else {
              alert(response);
          }
      }
  }

  request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  request.send();

}

function removeFromWatchlist(id) {

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
          let response = request.responseText;
          if (response == "success") {
              window.location.reload();
          } else {
              alert(response);
          }
      }
  }

  request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  request.send();

}

function removeFromRecent(id){
  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
          let response = request.responseText;
          if (response == "success") {
              window.location.reload();
          } else {
              alert(response);
          }
      }
  }

  request.open("GET", "removerecentProcess.php?id=" + id, true);
  request.send();
}

function basicSearch(x) {

  let txt = document.getElementById("basic_search_txt");

  let form = new FormData();
  form.append("t", txt.value);
  form.append("page", x);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          document.getElementById("basicSearchResult").innerHTML = response;
          let div = document.getElementById('myDiv');
          div.style.display = 'none';
          let div2 = document.getElementById('myDiv2');
          div2.style.display = 'none';
          let div3 = document.getElementById('myDiv3');
          div3.style.display = 'none';
      }
  }

  request.open("POST", "basicSearchProcess.php", true);
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

  request.open("GET", "updateInvoiceStatus.php?id=" + id, true);
  request.send();
}

let m;
function addFeedback(id) {
  let feedbackModal = document.getElementById("feedbackmodal" + id);
  let m = new bootstrap.Modal(feedbackModal);
  m.show();
}

function saveFeedback(id) {

  let type;

  if (document.getElementById("type1").checked) {
      type = 1;
  } else if (document.getElementById("type2").checked) {
      type = 2;
  } else if (document.getElementById("type3").checked) {
      type = 3;
  }

  let feedback = document.getElementById("feed");

  let form = new FormData();
  form.append("pid", id);
  form.append("t", type);
  form.append("f", feedback.value);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          let response = request.responseText;
          if (response == "success") {
              alert("Feedback saved.");
              m.hide();
          } else {
              alert(response);
          }
      }
  }

  request.open("POST", "saveFeedbackProcess.php", true);
  request.send(form);

}

function advancedSearch(x) {

  let txt = document.getElementById("t");
  let category = document.getElementById("c1");
  let brand = document.getElementById("b1");
  let model = document.getElementById("m");
  let condition = document.getElementById("c2");
  let color = document.getElementById("c3");
  let from = document.getElementById("pf");
  let to = document.getElementById("pt");
  let sort = document.getElementById("s");

  let form = new FormData();
  form.append("t", txt.value);
  form.append("cat", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("con", condition.value);
  form.append("col", color.value);
  form.append("pf", from.value);
  form.append("pt", to.value);
  form.append("s", sort.value);
  form.append("page", x);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 && request.readyState == 4) {
          let response = request.responseText;
          document.getElementById("view_area").innerHTML = response;
      }
  }

  request.open("POST", "advancedSearchProcess.php", true);
  request.send(form);

}