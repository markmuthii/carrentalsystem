var signupErrorContainer = $("#signupError"),
		signupErrorSpan = $("#signupError span"),
		signupSuccessContainer = $("#signupSuccess"),
		signupSuccessSpan = $("#signupSuccess span"),
		errors = "",
		loginErrorContainer = $("#loginError"),
		loginErrorSpan = $("#loginError span"),
		loginSuccessContainer = $("#loginSuccess"),
		loginSuccessSpan = $("#loginSuccess span");

$(document).ready(()=>{

	$("#registerForm").submit((e)=>{
		e.preventDefault();
		createUser();
	});
  
	$("#loginForm").submit((e)=>{
		e.preventDefault();
		logIn();
  });
  
  $("#carFilterForm").submit((e)=>{
		e.preventDefault();
		searchCar();
	});

	$("#profileForm").submit((e)=>{
		e.preventDefault();
		updateProfile();
	});

});

function createUser() {
	var firstname = $("#reg_firstname").val(),
			lastname =  $("#reg_lastname").val(),
			phonenumber =  $("#reg_phonenumber").val(),
			email =  $("#reg_email").val(),
			username =  $("#reg_username").val(),
			password =  $("#reg_password").val(),
			confirmPassword =  $("#reg_confirmPassword").val();
			

	if (password != confirmPassword) {
		errors += `<p>Passwords do not match</p>`;
		signupErrorSpan.append(errors);
		signupErrorContainer.removeClass("hidden");
		return;
	} else {
		var userData = {
			firstname: firstname,
			lastname: lastname,
			phonenumber: phonenumber,
			email: email,
			username: username,
			password: password,
			signup: true
		};

		$.ajax({
			type: "POST",
			url: baseUrl + "api/register.php",
			dataType: "json",
			data: userData,
			success: signupAjaxSuccess,
			error: signupAjaxError,
			complete: ()=>{console.log("Signup complete")}
		});
	}
}

function signupAjaxSuccess(res) {

	if (res.Error == false) {
		if (!signupErrorContainer.hasClass("hidden")) {
			signupErrorContainer.addClass("hidden");
		}
		var successMsg = res.Message;
		signupSuccessSpan.append(successMsg);
		signupSuccessContainer.removeClass("hidden").fadeIn();
		setTimeout(()=>{
			window.location.replace(baseUrl);
		}, 3000);
	}else{
		errors = res.Message;
		signupErrorSpan.text("");
		signupErrorSpan.append(errors);
		signupErrorContainer.removeClass("hidden").fadeIn();
	}

}

function signupAjaxError(err) {
	errors = "Error signing you up.";
	signupErrorSpan.append(errors);
	signupErrorContainer.removeClass("hidden");
}

function logIn() {
	var username = $("#log_username").val(),
			password =  $("#log_password").val();
			
	var userData = {
		username: username,
		password: password,
		login: true
	};

	$.ajax({
		type: "POST",
		url: baseUrl + "api/login.php",
		dataType: "json",
		data: userData,
		success: loginAjaxSuccess,
		error: loginAjaxError,
		complete: ()=>{console.log("Login complete")}
	});
}

function loginAjaxSuccess(res) {

	if (res.Error == false) {
		if (!loginErrorContainer.hasClass("hidden")) {
			loginErrorContainer.addClass("hidden");
		}
		var successMsg = res.Message + " Redirecting you...";
		loginSuccessSpan.append(successMsg);
		loginSuccessContainer.removeClass("hidden").fadeIn();
		setTimeout(()=>{
			if (res.Role == "su" || res.Role == "admin") {
				window.location.replace(baseUrl + "admin/");
			} else {
				window.location.replace(baseUrl);
			}
		}, 3000);
	}else{
		errors = res.Message;
		loginErrorSpan.text("");
		loginErrorSpan.append(errors);
		loginErrorContainer.removeClass("hidden").fadeIn();
	}

}

function loginAjaxError(err) {
	console.log(err);
	errors = "Error logging you in.";
	loginErrorSpan.append(errors);
	loginErrorContainer.removeClass("hidden");
}

function searchCar() {
  var makeId = $("#makeSelect").val(),
      modelId = $("#modelSelect").val(),
			priceRange = $("#price_range").val().split(","),
			min = priceRange[0],
			max = priceRange[1],
			carType = $("#carTypeSelect").val();
			
	// console.log(min, max);
	// return;
	

  if (makeId == 0) {
    alert("Please select a make");
    return;
  } else if (modelId == 0) {
    alert("Please select a model");
    return;
  } else if(carType == 0) {
    alert("Please select a type, whether new or used");
    return;
  }

  var carSearchData = {
    modelid : modelId,
    min : min,
    max : max,
    new : carType,
    searchcar : true
  }

  $.ajax({
    type: "POST",
    url: baseUrl + "api/cars.php",
    dataType: "json",
    data: carSearchData,
    success: showCars,
    error: (err)=>{console.log("Search Car Error:", err)},
    complete: ()=>{console.log("Search Car complete")}
  });

}

function showCars(carsData) {
	console.log(carsData);
	
  var carDisplayDiv = $("#carDisplayDiv"),
      output = "";
  // console.log(carsData.length);
  if (carsData.length > 0) {

    carsData.forEach(car => {
      // console.log(car);

      output += `
          <div class="col-list-3">
          <div class="recent-car-list">
            <div class="car-info-box"> <a href="#"><img src="${imageDir}${car['image']}" class="img-responsive" alt=""></a>
              <ul>
                <li><i class="fas fa-gas-pump" aria-hidden="true"></i>${car['fuel_type']}</li>
                <li><i class="fas fa-palette" aria-hidden="true"></i>${car['color']}</li>
                <li><i class="fas fa-fast-forward" aria-hidden="true"></i>${car['speed']}</li>
              </ul>
            </div>
            <div class="car-title-m">
              <h6><a href="#">${car['make']}  ${car['model']}</a></h6>
              <span class="price">$${car['hiring_price']}</span> 
            </div>
            <div class="inventory_info_m">
              <p>${car['description']}</p>
              <a href="${car['link']}" class="btn btn-xs uppercase" >Hire this car</a>
            </div>
          </div>
        </div>
      `;

    });

  } else {
    output = "<p>We do not have a car that matches your search criteria</p>"
  }

  carDisplayDiv.html(output);
  
}

function updateProfile() {
	var firstname = $("#firstname").val(),
			lastname = $("#lastname").val(),
			username = $("#username").val(),
			email = $("#email").val(),
			phonenumber = $("#phonenumber").val(),
			currentPassword = $("#currentPassword").val(),
			newPassword = $("#newPassword").val(),
			userid = $("#userid").val(),
			confirmPassword = $("#confirmPassword").val();

	if (currentPassword != "" && newPassword != "" && confirmPassword != "") {
		if (newPassword != confirmPassword) {
			showFeedback("error", "Passwords do not match");
			return;
		} else {
			pass(true);
		}
	} else if (currentPassword != "" && newPassword == "" && confirmPassword == "") {
		showFeedback("error", "Enter new password to change your password, or clear current password to proceed without changing the password.");
		return;
	} else if (currentPassword != "" && newPassword != "" && confirmPassword == "") {
		showFeedback("error", "Fill in the confirm password field, or clear current password to proceed without changing the password.");
		return;
	} else if (currentPassword != "" && newPassword == "" && confirmPassword != "") {
		showFeedback("error", "Enter new password to change your password, or clear current password to proceed without changing the password.");
		return;
	} else if (currentPassword == "" && newPassword != "" && confirmPassword != "") {
		showFeedback("error", "Enter the current password to proceed");
		return;
	} else if (currentPassword == "" && newPassword == "" && confirmPassword == "") {
		pass(false);
	}

	function pass(changePass) {
		var userData = {
			firstname: firstname,
			lastname: lastname,
			phonenumber: phonenumber,
			email: email,
			username: username,
			currentpassword: currentPassword,
			newpassword: newPassword,
			userid: userid,
			changepass: changePass,
			profileupdate: true
		};

		console.log(changePass);

		$.ajax({
			type: "POST",
			url: baseUrl + "api/profile.php",
			dataType: "json",
			data: userData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message);
				} else {
          showFeedback("success", res.Message + " Refreshing...");
          setTimeout(() => {
            window.location.reload();
          }, 4000);
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.");

			},
			complete: ()=>{
				console.log("Profile update complete")
			}
		});
	}
}

function showFeedback(type, feedback) {
	var feedbackContainer = $("#feedbackContainer");

	if (!feedbackContainer.hasClass("hidden")) feedbackContainer.addClass("hidden");


	feedbackContainer.text("");
	if (feedbackContainer.hasClass("alert-danger")) feedbackContainer.removeClass("alert-danger");
	if (feedbackContainer.hasClass("alert-success")) feedbackContainer.removeClass("alert-success");
	feedbackContainer.append(feedback);
	
	switch (type) {
		case "error":
			feedbackContainer.addClass("alert-danger");
			break;
		case "success":
			feedbackContainer.addClass("alert-success");
			break;
	}

	feedbackContainer.removeClass("hidden");

}

function deleteAccount() {
    var userid = $("#userid").val();

    var accountData = {
      userid : userid,
      deleteaccount : true
    }

    // console.log(accountData);
    
    $.ajax({
			type: "POST",
			url: baseUrl + "api/profile.php",
			dataType: "json",
			data: accountData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message);
				} else {
          showFeedback("success", res.Message + " Logging you out...");
          setTimeout(() => {
            window.location.reload();
          }, 4000);
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.");

			},
			complete: ()=>{
				console.log("Delete Account complete")
			}
		});
		
}
