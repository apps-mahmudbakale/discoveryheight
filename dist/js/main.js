$(document).ready(()=>{
	//Add User Blocks
	$('#addUser').click(()=>{
		//Variable Initialization

		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var phone = $('#phone').val();
		var role_id = $('#role_id').val();
		var section = $('#section').val();

		$.ajax({
			type: 'POST',
			url: '../Ajax/users/ajax.users.php',
			data:{firstname:firstname,lastname:lastname,username:username,password:password, phone:phone,role_id:role_id,section:section},
			cache: false,
			success: ((html)=>{
				$('#status').html(html);

				// console.log(html);
				// alert(role_id);
			})
		});
	});


//Update User Blcock


$('#editUser').click(()=>{
	//Variable Initialization

		var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var username = $('#username').val();
		var phone = $('#phone').val();
		var role_id = $('#role_id').val();
		var user_id = $('#user_id').val();
		var section = $('#section').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/users/ajax.edit.users.php',
		data:{user_id:user_id,firstname:firstname,lastname:lastname,username:username,phone:phone,role_id:role_id,section:section},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);
		})
	});

	//alert('Worked');

	});	


//Add Item Blocks
$('#addClass').click(()=>{
	//Variable Initialization

	var class_name = $('#class').val();
	var average = $('#average').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/class/ajax.class.php',
		data:{class:class_name,average:average},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addSubject').click(()=>{
	//Variable Initialization

	var subject_name = $('#subject_name').val();
	var section_id = $('#section_id').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/subjects/ajax.subject.php',
		data:{subject_name:subject_name,section_id:section_id},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editSubject').click(()=>{
	//Variable Initialization

	var subject_name = $('#subject_name').val();
	var section_id = $('#section_id').val();
	var subject_id = $('#subject_id').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/subjects/ajax.edit.subject.php',
		data:{subject_id:subject_id,subject_name:subject_name,section_id:section_id},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editClass').click(()=>{
	//Variable Initialization

	var class_id = $('#class_id').val();
	var class_name = $('#class').val();
	var average = $('#average').val();
	$.ajax({
		type: 'POST',
		url: '../Ajax/class/ajax.edit.class.php',
		data:{class:class_name,average:average,class_id:class_id},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);
		})
	});

	//alert('Worked');

	});	

$('#addPerm').click(()=>{
	//Variable Initialization

	var permission = $('#permission').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/permissions/ajax.permission.php',
		data:{permission:permission},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addPin').click(()=>{
	//Variable Initialization

	var pin = $('#pin').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/pin/ajax.pin.php',
		data:{pin:pin},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addFees').click(()=>{
	//Variable Initialization

	var fees_name = $('#fees_name').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/feesItem/ajax.feesItem.php',
		data:{fees_name:fees_name},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editFees').click(()=>{
	//Variable Initialization

	var fees_id = $('#fees_id').val();
	var fees_name = $('#fees_name').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/feesItem/ajax.feesItem.edit.php',
		data:{fees_id:fees_id,fees_name:fees_name},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addSection').click(()=>{
	//Variable Initialization

	var section = $('#section').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/section/ajax.section.php',
		data:{section:section},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});


$('#addSectionClass').click(()=>{
	//Variable Initialization

	var section = $('#section').val();
	var sectionclass = $('#sectionclass').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/sectionClass/ajax.sectionClass.php',
		data:{section:section,sectionclass:sectionclass},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});


$('#addRole').click(()=>{
	//Variable Initialization

	var role = $('#role').val();
	var permission = $('#permission').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/roles/ajax.role.php',
		data:{role:role,permission:permission},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});
$('#editSection').click(()=>{
	//Variable Initialization
	var section_id = $('#section_id').val();
	var section = $('#section').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/section/ajax.edit.section.php',
		data:{section_id:section_id,section:section},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editPerm').click(()=>{
	//Variable Initialization
	var perm_id = $('#perm_id').val();
	var permission = $('#permission').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/permissions/ajax.edit.permission.php',
		data:{perm_id:perm_id,permission:permission},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editRole').click(()=>{
	//Variable Initialization
	var role_id = $('#role_id').val();
	var role = $('#role').val();
	var permission = $('#permission').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/roles/ajax.edit.role.php',
		data:{role_id:role_id,role:role,permission:permission},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#addClassFees').click(()=>{
	//Variable Initialization
	var class_id = $('#class_id').val();
	var fees_id = $('#fees_id').val();
	var price = $('#price').val();
	var term = $('#term').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ClassFees/ajax.ClassFees.php',
		data:{class_id:class_id,fees_id:fees_id,price:price,term:term},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

$('#editClassFees').click(()=>{
	//Variable Initialization
	var class_price_id = $('#class_price_id').val();
	var class_id = $('#class_id').val();
	var fees_id = $('#fees_id').val();
	var price = $('#price').val();
	var term = $('#term').val();

	$.ajax({
		type: 'POST',
		url: '../Ajax/ClassFees/ajax.ClassFees.edit.php',
		data:{class_price_id:class_price_id,class_id:class_id,fees_id:fees_id,price:price,term:term},
		cache: false,
		success: ((html)=>{
			$('#status').html(html);

			// console.log(html);
			// alert(role_id);
		})
	});
});

});


$(()=>{
	$('#search_keyword').keyup(()=>{
		

		var search_keyword_value = $('#search_keyword').val();
		//alert(search_keyword_value);
		var dataString = 'search_keyword='+ search_keyword_value;

		if(search_keyword_value!='')
		{
		    $.ajax({
		        type: "POST",
		        url: "../Ajax/ajax.search.php",
		        data: dataString,
		        cache: false,
		        success: ((html)=>{
		        		$('#result').html(html).show();
		        	  // console.log(html);
		        	})
		        
		          
		        
		    });
		}
		return false;
	})
})