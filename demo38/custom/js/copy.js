function copyData(element) {
	//syarat harus memiliki parameter
	var temp = $("<input>");
	$("body").append(temp);
	temp.val(element).select();
	document.execCommand("copy");
	temp.remove();
	if (element == "") {
		Swal.fire({
			type: "warning",
			title: "Gagal Di Copy",
			showConfirmButton: false,
			timer: 700,
		});
	} else {
		Swal.fire({
			title: " Berhasil Di Copy",
			showConfirmButton: false,
			timer: 500,
		});
	}
}
