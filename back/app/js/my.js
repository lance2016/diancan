//���õ�����
function reset () {
	$("#toggleCSS").attr("href", "css/alertify.default.css");
	alertify.set({
		labels : {
			ok     : "OK",
			cancel : "Cancel"
		},
		delay : 5000,
		buttonReverse : false,
		buttonFocus   : "ok"
	});
}
	
function login(){
	var a=document.getElementById("login");
	var b=document.getElementById("register");
	a.style.display="block";
	b.style.display="none";
}
function register(){
	var a=document.getElementById("login");
	var b=document.getElementById("register");
	a.style.display="none";
	b.style.display="block";
}
