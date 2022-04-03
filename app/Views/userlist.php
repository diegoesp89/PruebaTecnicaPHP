<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ejercicio PHP FPay</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style>
	.avatar{
		max-width:30%; height:auto;
	}
	</style>
</head>
<body>

<!-- CONTENT -->
<div class="container">
<h1 class="text-center">Lista de Usuarios</h1>



<form id="addform" action="Api/adduser" method="post">
<input type="submit"  class="btn btn-primary" name="add" id="add" value="Agregar Usuario" />
</form>

	<table class="table table-dark" id="userlisttable">
  <thead>
    <tr>
      <th scope="col" width="10%">id</th>
      <th scope="col" width="30%">Nombre</th>
      <th scope="col" width="10%">Fecha Creacion</th>
      <th scope="col" width="50%">Avatar</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<!-- FOOTER: DEBUG INFO + COPYRIGHTS -->
</div>
<footer>
	
<!-- No footer today -->

</footer>

<!-- SCRIPTS -->

<script>
	var res;
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("hidden");
		}
	}

	function isValidHttpUrl(string) {
		let url;
		
		try {
			url = new URL(string);
		} catch (_) {
			return false;  
		}

	return url.protocol === "http:" || url.protocol === "https:";
	}

	function getData(){
         $.ajax({
            url: "<?php echo site_url('api/getData') ?>",
            type: 'POST',
            cache: false,
            //data: {object: 'value'},
            error: function(err) {
                alert(err.statusText);
            },
            success: function(data) {

               
				res = JSON.parse(data);
				var tr = '';
				console.log(data);
				 $.each(res, function(index, value) {					
					var date = new Date(value.createdAt);
					var dd = String(date.getDate()).padStart(2, '0');
					var mm = String(date.getMonth() + 1).padStart(2, '0');
					var yyyy = date.getFullYear();
					var hh =  ("0" + date.getUTCHours()).slice(-2);
					var min = ("0" + date.getMinutes()).slice(-2);

					if(!isValidHttpUrl(value.avatar)){
						value.avatar = "https://www.slotcharter.net/wp-content/uploads/2020/02/no-avatar.png";
					}

					date = dd + '/' + mm + '/' + yyyy + ' ' + hh + ':' + min + ' hrs';
					tr = '<tr><th scope="row">'+value.id+'</th><td width="10%">'+value.name+'</td><td width="30%">'+date+'</td><td width="10%"><image src="'+value.avatar+'" class="avatar" width="50%"><image></td></tr>'
					
					$("#userlisttable tbody").append(tr);
					console.log(tr);
				});
            }

        });
        }

		function postData(){
         $.ajax({
            url: "<?php echo site_url('api/postData') ?>",
            type: 'POST',
            cache: false,
            data: {name: 'diego', avatar: "url"},
            error: function(err) {
                alert(err.statusText);
            },
            success: function(data) {

               
				res = JSON.parse(data);
				var tr = '';
				console.log(data);
				//  $.each(res, function(index, value) {					
				// 	var date = new Date(value.createdAt);
				// 	var dd = String(date.getDate()).padStart(2, '0');
				// 	var mm = String(date.getMonth() + 1).padStart(2, '0');
				// 	var yyyy = date.getFullYear();
				// 	var hh =  String(date.getHours())
				// 	var min =  String(date.getMinutes())

				// 	date = mm + '/' + dd + '/' + yyyy + ' ' + hh + ':' + min + ' hrs';
				// 	tr = '<tr><th scope="row">'+value.id+'</th><td>'+value.name+'</td><td>'+date+'</td><td><image src="'+value.avatar+'" class="avatar"><image></td></tr>'
					
				// 	$("#userlisttable tbody").append(tr);
				// 	console.log(tr);
				// });
            }

        });
        }

		// $( "#adduserbtn" ).click(function() {
			
		// });
	getData();
</script>

<!-- -->

</body>
</html>
