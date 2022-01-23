$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();
	$("a[rel=external]").attr("target", "_blank");
}); 

function CheckPassword(pw, repw) { 
	var passw=  /^[A-Za-z]\w{7,14}$/;
	if(pw.value.match(passw) && pw == repw) {
		swal("Başarılı!", "Başarıyla kayıt olundu, yönlendiriliyorsunuz...", "success");
		return true;
	} else if(!pw.value.match(passw)) { 
		swal("Ooops!", "Şifreniz güçlü değil!", "error");
		return false;
	} else if(pw != repw) {
		swal("Ooops!", "Şifreler eşleşmiyor!", "error");
		return false;
	}
}