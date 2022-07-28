$(document).ready(function () {

	setInterval(function () {
		jQuery.ajax({
			type: "GET",
			url: "admin/assets/ajax/warning-public.php",
			data: "",
			success: function (data) {
				$(".warning").html(data);
			}
		});
	}, 60000);

	setInterval(function () {
		jQuery.ajax({
			type: "GET",
			url: "admin/assets/ajax/pengunjung-public.php",
			data: "",
			success: function (data) {
				$(".pengunjung").html(data);
			}
		});
	}, 1000);

	setInterval(function () {
		jQuery.ajax({
			type: "GET",
			url: "admin/assets/ajax/buku-public.php",
			data: "",
			success: function (data) {
				$(".tb1").html(data);
			}
		});
	}, 1000);

	setInterval(function () {
		jQuery.ajax({
			type: "GET",
			url: "admin/assets/ajax/absensi-public.php",
			data: "",
			success: function (data) {
				$(".tb2").html(data);
			}
		});
	}, 1000);




});