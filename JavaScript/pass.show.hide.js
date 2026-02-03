const password = document.querySelector("#password");
const showBtn = document.querySelector(".showBtn");


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
