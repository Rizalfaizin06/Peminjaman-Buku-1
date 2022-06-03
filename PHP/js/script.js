$(document).ready(function() {
	
	setInterval(function(){
		jQuery.ajax({
			type:"GET",
			url: "ajax/warning.php",
			data:"",
			success:function(data) {
				$(".warning").html(data);
			}
		});
	},60000);

	setInterval(function(){
		jQuery.ajax({
			type:"GET",
			url: "ajax/pengunjung.php",
			data:"",
			success:function(data) {
				$(".pengunjung").html(data);
			}
		});
	},1000);

	setInterval(function(){
		jQuery.ajax({
			type:"GET",
			url: "ajax/buku.php",
			data:"",
			success:function(data) {
				$(".tb1").html(data);
			}
		});
	},1000);

	setInterval(function(){
		jQuery.ajax({
			type:"GET",
			url: "ajax/absensi.php",
			data:"",
			success:function(data) {
				$(".tb2").html(data);
			}
		});
	},1000);




});