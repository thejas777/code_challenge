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
		border-left: 4px solid orange;
	}
	.card{
		padding:2px 2px 2px 10px;
		border-left: 4px solid blue;
	}
	.title{
		font-size:1.5em;
	}
	a{
		color: black;
	}
	</style>

    <body>
	<div class="container">
		<div class="row" id="data">
								
		</div>
	</div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    </body>
	<script>
	$(function(){
		var $list = $('#listContent');
		
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
		var search_string = getUrlParameter('s');
		//console.log(search_string);
		var $data = $('#data');
		
		$.ajax({
				type: 'GET',
				url: 'http://www.omdbapi.com/?apikey=852159f0&s='+search_string,
				dataType: "jsonp",
				success: function(data) {
					if(data.Response == 'True'){
					//console.log(data.Response);
					$.each(data.Search, function(i,datas){
					$data.append('<div class="col s12 m12"><a href="http://localhost/code_challenge/final.php?id='+datas.imdbID+'"><div class="card horizontal"><div class="card-image"><img src="'+datas.Poster+'" height="120px" width="100px"></div><div class="card-stacked"><div class="card-content"><p class="title">'+datas.Title+'</p><p><b>Year : </b>'+datas.Year+'</p></div></div></div></a></div>');
						//$data.append('<li>name:</li>');
					});
					$list.show();
					//console.log('success',data);
					}
					else {
						$data.append('<h3>No results found..</h3>');
					}
				}
		});
	});
	</script>
  </html>