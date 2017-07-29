 <!DOCTYPE html>
 <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <!-- Compiled and minified CSS -->
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
	<style>
	body{
		background-color:lightgray;
	}
	.container .row {
		margin-left: auto;
		margin-right: auto;
	}
	.card:hover {
		box-shadow: 5px 5px 5px #888888;
	}
	.title{
		font-size:2rem;
	}
	.director{
		font-size:14px;
	}
	.imdbRating{
		color: red;
	}
	.card .card-content p {
		margin: 2% 0;
	}
	</style>

    <body>
	<div class="container-fluid">
		<div class="row" id="data">
			 
		</div>
	</div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    </body>
	<script>
	var posterimgsrc = '';
	var title = '';
	$(function(){
			var getUrlParameter = function getUrlParameter(sParam) {
			var sPageURL = decodeURIComponent(window.location.search.substring(1)),
				sURLVariables = sPageURL.split('&'),
				sParameterName,
				i;

			for (i = 0; i < sURLVariables.length; i++) {
				sParameterName = sURLVariables[i].split('=');

				if (sParameterName[0] === sParam) {
					return sParameterName[1] === undefined ? true : sParameterName[1];
				}
			}
		};
		var search_string = getUrlParameter('id');
		var $data = $('#data');
		
		$.ajax({
				type: 'GET',
				url: 'http://www.omdbapi.com/?apikey=852159f0&i='+search_string,
				success: function(data) {
					if(data.Response == 'True'){
					//console.log(data.Response);
					$data.append('<div class="col s12 m12"><div class="card horizontal"><div class="card-image"><img id="postersrc" src="'+data.Poster+'"></div><div class="card-stacked"><div class="card-content"><p class="title">'+data.Title+'</p><p class=""><b>Category : </b>'+data.Genre+'</p><p class="director"><b>Director : </b>'+data.Director+'</p><p class="actors"><b>Actors : </b>'+data.Actors+'</p><p class="imdbRating"><b>Imdb Ratings : </b>'+data.imdbRating+'</p><p class=""><b>Year : </b>'+data.Year+'</p><p class=""><b>Story : </b>'+data.Plot+'</p><p class=""><b>Language : </b>'+data.Language+'</p></div></div></div></div>');
						//$data.append('<li>name:</li>');
					//$list.show();
					posterimgsrc = data.Poster;
					title = data.Title;
					setlocalStorage();
					//console.log('success',data);
					}
					else {
						$data.append('<h3>No results found..</h3>');
					}
				}
		});
	});
	</script>
	<script>
		//storing page history on locatstorage
		function setlocalStorage(){
			//var posterimgsrc = document.getElementById("postersrc").src;
			var path = window.location.href;
			var items = JSON.parse(localStorage.getItem('testObject'));
			if(items!= null){
				console.log(items.length);
				
					if(items.length >= 6) {
					  items.shift(); //the first item in the array is removed. So length is 2
					  localStorage.setItem('testObject', JSON.stringify(items));
					  //console.log(items);
					  var newitem = { 'url': window.location.href, 'title': title, 'poster': posterimgsrc };
					  items = JSON.parse(localStorage.getItem('testObject'));
					  items.push(newitem);
					  localStorage.setItem('testObject', JSON.stringify(items));
					}
					else{
					  var newitem = { 'url': window.location.href, 'title': title, 'poster': posterimgsrc };
					  //items = JSON.parse(localStorage.getItem('testObject'));
					  items.push(newitem);
					  localStorage.setItem('testObject', JSON.stringify(items));
					}
				
			}
			else{
				var items = [{ 'url': window.location.href, 'title': title, 'poster': posterimgsrc }];
				localStorage.setItem('testObject', JSON.stringify(items));
			}
		};
	</script>
  </html>