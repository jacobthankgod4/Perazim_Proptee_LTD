const form = document.querySelector("#form");
const type = form.querySelector("#school_type");
const school_name = form.querySelector("#school_name");
// const lastname = form.querySelector("#lastname");
const email = form.querySelector("#school_email");
const password = form.querySelector("#school_pass");
const showBtn = form.querySelector(".showBtn");
const showBtn1 = form.querySelector(".showBtn1");
const confirm__password = form.querySelector("#confirmPass");
const Tab = document.querySelector(".errMessage")


form.onsubmit = (e) => {

	 e.preventDefault();

	Validate();

	// console.log("hello");
}

showBtn.onclick = () =>{
	if (password.type=='password') {
		password.type='text';
		// showBtn.innerText = 'Hide';
        showBtn.classList.remove("fa-eye-slash");
        showBtn.classList.add("fa-eye");
	} else {
		password.type='password';
		showBtn.classList.remove("fa-eye");
        showBtn.classList.add("fa-eye-slash");
	}
}

showBtn1.onclick = () =>{
	if (confirm__password.type=='password') {
		confirm__password.type='text';
		showBtn1.classList.remove("fa-eye-slash");
        showBtn1.classList.add("fa-eye");
	} else {
		confirm__password.type='password';
		showBtn1.classList.remove("fa-eye");
        showBtn1.classList.add("fa-eye-slash");
	}
}

const validate__error =(element, message) => {

    if (element==password || element==confirmPass || element==type) {
        const valid = element.parentElement;
        const valid1 = valid.parentElement;
        const errorDisplay = valid1.querySelector('.errorMessage');

        errorDisplay.innerText = message;
        element.classList.add('error');
        element.classList.remove('success');
        errorDisplay.style.display='block';
    } else {
        const valid = element.parentElement;
        const errorDisplay = valid.querySelector('.errorMessage');

        errorDisplay.innerText = message;
        element.classList.add('error');
        element.classList.remove('success');
        errorDisplay.style.display='block';
    }

}

const validate__success = element => {


    if (element==password || element==confirmPass || element==type) {
        const valid = element.parentElement;
        const valid1 = valid.parentElement;
        const errorDisplay = valid1.querySelector('.errorMessage');

        errorDisplay.innerText = "";
        element.classList.add('success');
        element.classList.remove('error');
        errorDisplay.style.display='none';
    } else {
        const valid = element.parentElement;
        const errorDisplay = valid.querySelector('.errorMessage');

        errorDisplay.innerText = "";
        element.classList.add('success');
        element.classList.remove('error');
        errorDisplay.style.display='none';
    }

}

const Validate = () => {

    const type1 = type.value.trim();
	const school_name1 = school_name.value.trim();
	// const lastname1 = lastname.value.trim();
	const email1 = email.value.trim();
	const password1 = password.value.trim();
	const confirm__password1 = confirm__password.value.trim();

	const isValidName = name => {
		const reg__ex = /^[A-Z\' .-]{2,45}$/i;
		return reg__ex.test(String(name))
	}

	const isValidPassword = name => {
		const reg__ex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,}$/;
		return reg__ex.test(String(name));
	}

    if (type1==="") {
		validate__error(type, 'field cant be empty');

        var first = "false";
	} else{
		validate__success(type);

        var first = "true";
	}

	if (school_name1==="") {
		validate__error(school_name, 'field cant be empty');

        var second = "false";
	} else if(!isValidName(school_name1)){
		validate__error(school_name, 'name can only contain letters' );

        var second = "false";
	}else{
		validate__success(school_name);

        var second = "true";
	}

	// if (lastname1==="") {
	// 	validate__error(lastname, 'field cant be empty');

    //     var third = "false";
	// } else if(!isValidName(lastname1)){
	// 	validate__error(lastname, 'name can only contain letters' );

    //     var third = "false";
	// }else{
	// 	validate__success(lastname);

    //     var third = "true";
	// }

	if (email1==="") {
		validate__error(email, 'field cant be empty');

        var fourth = "false";
	}else{
		validate__success(email);

        var fourth = "true";
	}

	if (password1==="") {
		validate__error(password, 'field cant be empty');

        var fifth = "false";
	} else if(!isValidPassword(password1)){
		validate__error(password, 'Password must contain an uppercase and a lowercase letter, a number and must be more then 6' );

        var fifth = "false";
	}else{
		validate__success(password);

        var fifth = "true";
	}

	if (confirm__password1==="") {
		validate__error(confirmPass, 'field cant be empty');

        var sixth = "false";
	} else if(!isValidPassword(confirm__password1)){
		validate__error(confirmPass, 'confirm password does not match original password' );

        var sixth = "false";
	}else{
		validate__success(confirmPass);

        var sixth = "true";
	}

    if (first=="true" && second=="true" && fourth=="true"  && fifth=="true"  && sixth=="true") {

		console.log("hellojjjj");

		let xhr = new XMLHttpRequest();
		xhr.open("POST", "Includes//register/processor/data1.php", true);
		xhr.onload = () => {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				if (xhr.status === 200) {
					let data = xhr.response;
					Tab.classList.add(data);

					if (stab=document.querySelector(".hi2")) {
						Swal.fire({
							icon: 'success',
							title: 'Hurray',
							text: 'you have successfully registered your school...You can login now',  
							showClass: {
							  popup: 'animate__animated animate__fadeInDown'
							},
							hideClass: {
							  popup: 'animate__animated animate__fadeOutUp'
							}
						  })
					} else if(tab=document.querySelector(".hello0")) {
						Swal.fire({
							icon: 'error',
							title:'Oops',
							text: 'please-check-your-form-for-error',  
							showClass: {
							  popup: 'animate__animated animate__fadeInDown'
							},
							hideClass: {
							  popup: 'animate__animated animate__fadeOutUp'
							}
						  })
					}else if(tab=document.querySelector(".hello1")) {
						Swal.fire({
							icon: 'error',
							title:'Oops',
							text: 'email has already been registered by another user',  
							showClass: {
							  popup: 'animate__animated animate__fadeInDown'
							},
							hideClass: {
							  popup: 'animate__animated animate__fadeOutUp'
							}
						  })
					}else if(tab=document.querySelector(".hello2")) {
						Swal.fire({
							icon: 'error',
							title:'Oops',
							text: 'unable to registere your school...please try again later.',  
							showClass: {
							  popup: 'animate__animated animate__fadeInDown'
							},
							hideClass: {
							  popup: 'animate__animated animate__fadeOutUp'
							}
						  })
					}
				
				}
			}
		}	
		let formData = new FormData(form);
		xhr.send(formData);

		}

		
		
}
