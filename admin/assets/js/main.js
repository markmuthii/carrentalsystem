var aboutEditor, termsEditor, privacyEditor;
var imgBaseSrc;

$(document).ready(()=>{
	imgBaseSrc = $("#currentcarimage").attr("src");

	$('#chooseCarImage').bind('change', function () {
	  var filename = $("#chooseCarImage").val();
	  if (/^\s*$/.test(filename)) {
	    $(".file-upload").removeClass('active');
	    $("#noFile").text("No file chosen..."); 
	  }else {
	    $(".file-upload").addClass('active');
	    $("#noFile").text(filename.replace("C:\\fakepath\\", "")); 
	  }
	});

	$('#edit_chooseCarImage').bind('change', function () {
	  var filename = $("#edit_chooseCarImage").val();
	  if (/^\s*$/.test(filename)) {
	    $(".file-upload").removeClass('active');
	    $("#edit_noFile").text("No file chosen..."); 
	  }else {
	    $(".file-upload").addClass('active');
	    $("#edit_noFile").text(filename.replace("C:\\fakepath\\", "")); 
	  }
	});


  ClassicEditor
  .create(document.querySelector('#aboutcompanyeditor'), {
    removePlugins: ["ImageUpload"],
    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
    heading: {
      options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
      ]
  }
  })
  .then(editor => {
    // console.log(editor);
    aboutEditor = editor;
  })
  .catch(error => {
    console.error(error);
  });

  ClassicEditor
  .create(document.querySelector('#privacycompanyeditor'), {
    removePlugins: ["ImageUpload"],
    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
    heading: {
      options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
      ]
  }
  })
  .then(editor => {
    // console.log(editor);
    privacyEditor = editor;
  })
  .catch(error => {
    console.error(error);
  });

  ClassicEditor
  .create(document.querySelector('#termscompanyeditor'), {
    removePlugins: ["ImageUpload"],
    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
    heading: {
      options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
      ]
  }
  })
  .then(editor => {
    // console.log(editor);
    termsEditor = editor;
  })
  .catch(error => {
    console.error(error);
  });

	$("#addAdminForm").submit((e)=>{
		e.preventDefault();
		createAdmin();
	});

	$("#addCompanyForm").submit((e)=>{
		e.preventDefault();
		addCompany();
	});

	$("#editCompanyForm").submit((e)=>{
		e.preventDefault();
		editCompanyComplete();
	});

	// $("#editMakeForm").submit((e)=>{
	// 	e.preventDefault();
	// 	editMakeComplete();
	// });

	// $("#editModelForm").submit((e)=>{
	// 	e.preventDefault();
	// 	editModelComplete();
  // });

  $("#addCompanyAbout").submit((e)=>{
		e.preventDefault();
    // editModelComplete();
    // console.log(aboutEditor.getData());
    updateCompanyContacts(aboutEditor.getData(), termsEditor.getData(), privacyEditor.getData());
  });
  
  

	$("#addModelForm").submit((e)=>{
		e.preventDefault();
		var modelName = $("#modelname").val(),
				makeId = $("#makeSelect").val();

		var modelData = {
			modelname : modelName,
			makeid : makeId,
			modelAdd: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/models.php",
			dataType: "json",
			data: modelData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message);
				} else {
					showFeedback("success", res.Message + " Refreshing...");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.");
			},
			complete: ()=>{
				console.log("Model Add complete")
			}
		});
	});

	$("#addMakeForm").submit((e)=>{
		e.preventDefault();
		var makename = $("#makename").val();

		var makeData = {
			makename : makename,
			makeadd: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/makes.php",
			dataType: "json",
			data: makeData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message);
				} else {
					showFeedback("success", res.Message + " Refreshing...");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.");
			},
			complete: ()=>{
				console.log("Model Add complete")
			}
		});
	});

	$("#addCarForm").submit((e)=>{
		var feedbackContainer = $("#feedbackContainer");

		e.preventDefault();
		if (!feedbackContainer.hasClass("hidden")) feedbackContainer.addClass("hidden");
		var hiringprice = $("#hiringprice").val(),
				fueltype = $("#fueltype").val(),
				color = $("#color").val(),
				link = $("#link").val(),
				companyid = $("#companyid").val(),
				carimage = $("input[type=file]")[0].files[0],
				cartype = $("input[name='cartype']:checked").val(),
				carimagename = $("#noFile").text(),
				description = $("#description").val(),
				modelid = $("#carModelSelect").val(),
				speed = $("#speed").val(),
				makeid = $("#makeid").val();


		// VALIDATION
		// Image type:
		var isImageValid = imageIsValid(carimagename);
		console.log(isImageValid);
		if (!isImageValid) {
			showFeedback("error", "Only image files allowed.");
			return;
		}

		// Model Selected


		// Link is link


		// Color and fuel type do not contain numbers


		var carData = new FormData();
				carData.append("hiringprice", hiringprice);
				carData.append("fueltype", fueltype);
				carData.append("color", color);
				carData.append("link", link);
				carData.append("companyid", companyid);
				carData.append("carimage", carimage);
				carData.append("description", description);
				carData.append("cartype", cartype);
				carData.append("modelid", modelid);
				carData.append("speed", speed);
				carData.append("makeid", makeid);
				carData.append("carAdd", true);

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/cars.php",
			dataType: "json",
			cache: false,
			processData: false,
			contentType: false,
			data: carData,
			success: (res)=>{
				console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message);
				} else {
					showFeedback("success", res.Message);
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.");

			},
			complete: ()=>{
				console.log("Car Add complete")
			}
		});
	});

	$("#editCarForm").submit((e)=>{
		e.preventDefault();
		var hiringprice = $("#edit_hiringprice").val(),
				fueltype = $("#edit_fueltype").val(),
				color = $("#edit_color").val(),
				link = $("#edit_link").val(),
				companyid = $("#edit_companyid").val(),
				carimage = $("input[type=file]")[1].files[0],
				cartype = $("input[name='edit_cartype']:checked").val(),
				carimagename = $("#edit_noFile").text(),
				description = $("#edit_description").val(),
				modelid = $("#edit_carModelSelect").val(),
				speed = $("#edit_speed").val(),
				carid = $("#car_id").val(),
				makeid = $("#edit_makeid").val();

		var isImageValid = imageIsValid(carimagename);
		console.log(isImageValid);
		if (!isImageValid) {
			showFeedback("error", "Only image files allowed.", "editCarFeedbackDiv");
			return;
		}

		var carData = new FormData();
				carData.append("hiringprice", hiringprice);
				carData.append("fueltype", fueltype);
				carData.append("color", color);
				carData.append("link", link);
				carData.append("companyid", companyid);
				carData.append("carimage", carimage);
				carData.append("description", description);
				carData.append("cartype", cartype);
				carData.append("modelid", modelid);
				carData.append("speed", speed);
				carData.append("makeid", makeid);
				carData.append("carid", carid);
				carData.append("carupdate", true);

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/cars.php",
			dataType: "json",
			cache: false,
			processData: false,
			contentType: false,
			data: carData,
			success: (res)=>{
				console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message, "editCarFeedbackDiv");
				} else {
					showFeedback("success", res.Message + " Refreshing...", "editCarFeedbackDiv");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.", "editCarFeedbackDiv");

			},
			complete: ()=>{
				console.log("Edit Car complete");
			}
		});
	});
});

function createAdmin() {

	var firstname = $("#firstname").val(),
			lastname =  $("#lastname").val(),
			phonenumber =  $("#phonenumber").val(),
			email =  $("#email").val(),
			username =  $("#username").val(),
			password =  $("#password").val(),
			companyid =  $("#companyid").val(),
			adminRole = $("#adminrole").val();

	if (adminRole == "0") {
		showFeedback("error", "Please select as admin role");
		return;
	} else if (adminRole == "admin" && companyid == "0") {
		showFeedback("error", `Please select which company ${firstname} belongs to.`);
		return;
	}

	var adminData = {
			firstname: firstname,
			lastname: lastname,
			phonenumber: phonenumber,
			email: email,
			username: username,
			password: password,
			companyid: companyid,
			adminrole: adminRole,
			adminadd: true
		};

	$.ajax({
		type: "POST",
		url: "api/users.php",
		dataType: "json",
		data: adminData,
		success: (res)=>{
			// console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message);
			} else {
				showFeedback("success", res.Message);
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.");

		},
		complete: ()=>{
			console.log("Admin Add complete")
		}
	});

}

function adminRoleChanged() {
  var adminRole = $("#adminrole").val(),
      companySelect = $("#companySelectDiv");

  console.log(adminRole);
  if (adminRole == "admin") {
    if (companySelect.hasClass("hidden")) {
      companySelect.removeClass("hidden");
    }
  } else if (adminRole == "0" || adminRole == "su" ) {
    if (!companySelect.hasClass("hidden")) {
      companySelect.addClass("hidden");
    }
  }
}

function demoteAdmin(adminId) {
  bootbox.confirm({
    title: "Demote Administrator to Client?",
    message: "Are you sure you want to demote the admin? Please note that this action cannot be undone.",
    buttons: {
        cancel: {
						label: 'Cancel',
						className: 'btn-default'
        },
        confirm: {
						label: 'Demote',
						className: 'btn-danger'
        }
    },
    callback: function (result) {
        if (result) {
					demoteAdminConfirmed();
				} else {
					return;
				}
    }
  });
  
  function demoteAdminConfirmed() {
    var data = {
      adminid : adminId,
      adminedit : true
    }
  
    $.ajax({
      type: "POST",
      url: adminBaseUrl + "api/users.php",
      dataType: "json",
      data: data,
      success: (res)=>{
        console.log(res);
        if (res.Error == true) {
          showFeedback("error", res.Message);
        } else {
          showFeedback("success", res.Message + " Refreshing...");
          refresh();
        }
      },
      error: (err)=>{
        console.log(err);
        showFeedback("error", "An error occurred. Please try again.");
      },
      complete: ()=>{
        console.log("Demote Admin complete")
      }
    });
  }
}

function addCompany() {
	var companyname = $("#companyname").val();

	var companyData = {
		companyname : companyname,
		companyadd: true
	};

	$.ajax({
		type: "POST",
		url: adminBaseUrl + "api/company.php",
		dataType: "json",
		data: companyData,
		success: (res)=>{
			// console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message);
			} else {
				showFeedback("success", res.Message + " Refreshing...");
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.");
		},
		complete: ()=>{
			console.log("Company Add complete")
		}
	});
}

function editCompany(id) {
	$("#edit_companyname").val(companies[id].name);
	$("#edit_companyid").val(id);
	$("#editcompanyform").modal("show");
}

function editCompanyComplete() {
	var companyid = $("#edit_companyid").val()
			companyname = $("#edit_companyname").val();

	var companyData = {
		companyname : companyname,
		companyid : companyid,
		companyupdate : true
	}

	$.ajax({
		type: "POST",
		url: adminBaseUrl + "api/company.php",
		dataType: "json",
		data: companyData,
		success: (res)=>{
			// console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message, "editCompanyFeedbackDiv");
			} else {
				showFeedback("success", res.Message + " Refreshing...", "editCompanyFeedbackDiv");
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.", "editCompanyFeedbackDiv");
		},
		complete: ()=>{
			console.log("Company Edit complete")
		}
	});
}

function updateCompanyContacts(aboutDetails, termsOfService, privacyPolicy) {
  var facebook = $("#facebook_link").val(),
      instagram = $("#instagram_link").val(),
      twitter = $("#twitter_username").val(),
      googleplus = $("#google_plus").val(),
      email = $("#contact_email").val(),
      about = aboutDetails,
      terms = termsOfService,
      privacy = privacyPolicy,
			phonenumber = $("#contact_phonenumber").val();

	var contactData = {
		facebook : facebook,
		twitter : twitter,
		instagram : instagram,
		googleplus : googleplus,
		phonenumber : phonenumber,
		email : email,
		about : about,
		terms : terms,
		privacy : privacy,
		contactsupdate : true
	}

	$.ajax({
		type: "POST",
		url: adminBaseUrl + "api/company.php",
		dataType: "json",
		data: contactData,
		success: (res)=>{
			// console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message);
			} else {
				showFeedback("success", res.Message + " Refreshing...");
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.");
		},
		complete: ()=>{
			console.log("Company Edit complete")
		}
	});
}

function deleteCompany(id) {
	bootbox.confirm({
    title: "Delete Company Entry",
    message: "Are you sure you want to delete the company? Please note that this action cannot be undone.",
    buttons: {
        cancel: {
						label: 'Cancel',
						className: 'btn-default'
        },
        confirm: {
						label: 'Delete',
						className: 'btn-danger'
        }
    },
    callback: function (result) {
        if (result) {
					deleteCompanyConfirmed();
				} else {
					return;
				}
    }
	});

	function deleteCompanyConfirmed() {

		var deleteData = {
			companyid : id,
			deletecompany: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/company.php",
			dataType: "json",
			data: deleteData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message, "feedbackDiv");
				} else {
					showFeedback("success", res.Message + " Refreshing...", "feedbackDiv");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.", "feedbackDiv");
			},
			complete: ()=>{
				console.log("Model Add complete")
			}
		});
		
	}
}

function editMake(id) {
	$("#edit_makename").val(makes[id].name);
	$("#edit_makeid").val(id);
	$("#editmakeform").modal("show");
}

function editMakeComplete() {
	var makeid = $("#edit_makeid").val()
			makename = $("#edit_makename").val();

	var makeData = {
		makename : makename,
		makeid : makeid,
		makeupdate : true
	}

	$.ajax({
		type: "POST",
		url: adminBaseUrl + "api/makes.php",
		dataType: "json",
		data: makeData,
		success: (res)=>{
			// console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message, "editFeedbackContainer");
			} else {
				showFeedback("success", res.Message + " Refreshing...", "editFeedbackContainer");
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.", "editFeedbackContainer");
		},
		complete: ()=>{
			console.log("Make Edit complete")
		}
	});
}

function deleteMake(id) {
	bootbox.confirm({
    title: "Delete Make Entry",
    message: "Are you sure you want to delete the make? Please note that this action cannot be undone.",
    buttons: {
        cancel: {
						label: 'Cancel',
						className: 'btn-default'
        },
        confirm: {
						label: 'Delete',
						className: 'btn-danger'
        }
    },
    callback: function (result) {
        if (result) {
					deleteMakeConfirmed();
				} else {
					return;
				}
    }
	});

	function deleteMakeConfirmed() {

		var deleteData = {
			makeid : id,
			deletemake: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/makes.php",
			dataType: "json",
			data: deleteData,
			success: (res)=>{
				console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message, "feedbackDiv");
				} else {
					showFeedback("success", res.Message + " Refreshing...", "feedbackDiv");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.", "feedbackDiv");
			},
			complete: ()=>{
				console.log("Make Delete complete");
			}
		});
		
	}
}

function editModel(id) {
	$("#edit_modelname").val(models[id].name);
	$("#edit_modelid").val(id);
	$("#edit_makeSelect").val(models[id].makeId);
	$("#edit_makeSelect").change();
	$("#editmodelform").modal("show");
}

function editModelComplete() {
	var modelid = $("#edit_modelid").val(),
			modelname = $("#edit_modelname").val(),
			makeid = $("#edit_makeSelect").val();

	var modelData = {
		modelname : modelname,
		modelid : modelid,
		makeid : makeid,
		modelupdate : true
	}

	$.ajax({
		type: "POST",
		url: adminBaseUrl + "api/models.php",
		dataType: "json",
		data: modelData,
		success: (res)=>{
			console.log(res);
			if (res.Error == true) {
				showFeedback("error", res.Message, "editFeedbackContainer");
			} else {
        showFeedback("success", res.Message + " Refreshing...", "editFeedbackContainer");
				refresh();
			}
		},
		error: (err)=>{
			console.log(err);
			showFeedback("error", "An error occurred. Please try again.", "editFeedbackContainer");
		},
		complete: ()=>{
			console.log("Make Edit complete")
		}
	});
}

function deleteModel(id) {
	bootbox.confirm({
    title: "Delete Model Entry",
    message: "Are you sure you want to delete the model? Please note that this action cannot be undone.",
    buttons: {
        cancel: {
						label: 'Cancel',
						className: 'btn-default'
        },
        confirm: {
						label: 'Delete',
						className: 'btn-danger'
        }
    },
    callback: function (result) {
        if (result) {
					deleteModelConfirmed();
				} else {
					return;
				}
    }
	});

	function deleteModelConfirmed() {

		var deleteData = {
			modelid : id,
			deletemodel: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/models.php",
			dataType: "json",
			data: deleteData,
			success: (res)=>{
				console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message, "feedbackDiv");
				} else {
					showFeedback("success", res.Message + " Refreshing...", "feedbackDiv");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.", "feedbackDiv");
			},
			complete: ()=>{
				console.log("Make Delete complete");
			}
		});
		
	}
}

function modelSelectChanged() {
	var modelID = $("#carModelSelect").val();   

	if (modelID == "0") {
		$("#make_name").val("Please select a model");
		$("#makeid").val("0");
	}else{
		var makeID = modelsObj[modelID][0],
				makeNAME = modelsObj[modelID][1];
		$("#make_name").val(makeNAME);
		$("#makeid").val(makeID);
	}
}

function deleteCar(id) {

	bootbox.confirm({
    title: "Delete Car Entry",
    message: "Are sure you want to delete the car? Please note that this action cannot be undone.",
    buttons: {
        cancel: {
						label: 'Cancel',
						className: 'btn-default'
        },
        confirm: {
						label: 'Delete',
						className: 'btn-danger'
        }
    },
    callback: function (result) {
        if (result) {
					deleteCarConfirmed();
				} else {
					return;
				}
    }
	});

	function deleteCarConfirmed() {

		var deleteData = {
			carid : id,
			deletecar: true
		};

		$.ajax({
			type: "POST",
			url: adminBaseUrl + "api/cars.php",
			dataType: "json",
			data: deleteData,
			success: (res)=>{
				// console.log(res);
				if (res.Error == true) {
					showFeedback("error", res.Message, "feedbackDiv");
				} else {
					showFeedback("success", res.Message + " Refreshing...", "feedbackDiv");
					refresh();
				}
			},
			error: (err)=>{
				console.log(err);
				showFeedback("error", "An error occurred. Please try again.", "feedbackDiv");
			},
			complete: ()=>{
				console.log("Car Delete complete")
			}
		});
		
	}
}

function editModelSelectChanged() {
	var modelID = $("#edit_carModelSelect").val();   

	if (modelID == "0") {
		$("#edit_make_name").val("Please select a model");
		$("#edit_makeid").val("0");
	}else{
		var makeID = modelsObj[modelID][0],
				makeNAME = modelsObj[modelID][1];
		$("#edit_make_name").val(makeNAME);
		$("#edit_makeid").val(makeID);
	}
}

function editCar(id) {

	$("#currentcarimage").attr("src", "");
	$("#currentcarimage").attr("src", `${imgBaseSrc}${cars[id].image}`);

  $("#edit_hiringprice").val(cars[id].hiringPrice);
	$("#edit_fueltype").val(cars[id].fuel);
	$("#edit_color").val(cars[id].color);
	$("#edit_link").val(cars[id].link);
	$("#edit_companyid").val(cars[id].companyId);
	$("input[name='edit_cartype']:checked").val(cars[id].new);
	$("input[name='edit_cartype']:checked").change();
	$("#edit_noFile").text(cars[id].image);
	$("#edit_description").val(cars[id].description);
	$("#edit_carModelSelect").val(cars[id].modelId);
	$("#edit_carModelSelect").change();
	$("#edit_speed").val(cars[id].speed);
	$("#edit_makeid").val(cars[id].makeId);
	$("#car_id").val(id);

	$("#editcarform").modal("show");
}

function showFeedback(type, feedback, feedbackContainer="feedbackContainer") {
  var title = type == "error" ? "Error Processing Request" : "Request Processed Successfully";
  if($(".modal").is(":visible")) {
    $(".modal").modal("hide");
  }
  setTimeout(()=>{
    bootbox.alert({
      title: title,
      message: feedback,
      backdrop: true
    });
  }, 2000);
  

  return;

	var feedbackContainer = $(`#${feedbackContainer}`);

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

function imageIsValid(file) {
	console.log(file);
	var arr = file.split("."),
			ext = arr[arr.length - 1];
	console.log(ext);
	return (ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "gif") ? true : false;
}

function refresh() {
	setTimeout(() => {
		window.location.reload();
	}, 4000);
}


