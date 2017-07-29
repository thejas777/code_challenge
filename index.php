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
	span {
		position: absolute;
		top: 22px;
		cursor: pointer;
		margin-left: 10px;
	}
	#searchbox {
		border: 1px solid grey;
		border-radius: 45px;
		background-color: white;
	}
	#searchbox:focus{
		border: 1px solid #26a69a; 
		box-shadow:1px 1px 9px
	}
	.search-thumb{
		width: 26px;
		height: 30px;
		margin: 10px;
	}
	li {
		border-bottom: #cccccc 1px solid;
		padding: 5px 0px;
	}
	.search-link{
		display: flex;
	}
	.search-link:hover{
		background-color: rgba(239, 239, 239, 0.86);
	}
	.card-action{
		min-height:55px;
		
	}
	</style>

    <body>
	<div class="container">
		<div class="container">
			<form>
				<div class="col s6" style="padding:10px 10px 0 10px;">
				  <span><i class="material-icons">search</i></span>
				  <input style="padding-left:50px; width:95%;margin-bottom: 6px;" id="searchbox" type="text" class="validate" autocomplete="off" placeholder="Search..">
				 </div>
			</form>
			<div id="listContent" style="max-height:250px; overflow-y:scroll;display:none;">
				<ul class="data" id="data" style="background-color:white;margin-top:-4px;padding:6px;"> </ul>
			</div>
			<div class="row" id="thubmnail-dev">
				
			</div>
		</div>
	</div>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    </body>
	<script>
	$(function(){
		var $data = $('#data');
		var $list = $('#listContent');
		
		//$('#searchbox').on("blur", function(){   
			//$list.slideUp();
		//});
		
		$("#searchbox").keypress(function(event){
			var value = $(this).val();
			var noWhitespaceValue = value.replace(/\s+/g, '+');
			if(event.which==13){
				//alert('enter entered');
				event.preventDefault();
				var fullUrl = "http://localhost/code_challenge/intermediate.php?s="+value;
				//alert(fullUrl);
				location.href = fullUrl;
			 }
		});
		
		$("#searchbox").on('keyup', function(e){
			e.preventDefault();
			var value = $(this).val();
			var noWhitespaceValue = value.replace(/\s+/g, '+');
			var noWhitespaceCount = noWhitespaceValue.length;
			console.log(this.value.length);	
			if ((e.which !== 32) && (this.value.length >= 3)) {				
				$data.empty();
				// Call API
				//alert(noWhitespaceValue);
				$.ajax({
					method: 'GET',
					url: 'http://www.omdbapi.com/?apikey=852159f0&s='+noWhitespaceValue,
					dataType: "jsonp",
					success: function(data) {
						if(data.Response == 'True'){
						//console.log(data.Response);
						$.each(data.Search, function(i,datas){
							$data.append('<li><a class="search-link" href="http://localhost/code_challenge/final.php?id='+datas.imdbID+'" target="_blank"><img class="search-thumb" src="'+datas.Poster+'"/><p>  '+datas.Title+', Year: '+datas.Year+'</p></a></li>');
							//$data.append('<li>name:</li>');
						});
						$list.show();
						//console.log('success',data);
						}
					}
				});
			}
			if (this.value.length < 3){
				$list.slideUp();
			}
        });
		
	});
	</script>
	<script>
		$(function(){
			var $thumbnail = $('#thubmnail-dev');
			var items = JSON.parse(localStorage.getItem('testObject'));
			console.log(items);
			$.each(items, function(i,datas){
				$thumbnail.append('<div class="col s4 m4"><a href="'+datas.url+'"><div class="card"><div class="card-image"><img src="'+datas.poster+'" width="100px;" height="150px;"></div><div class="card-action">Most Recent Searchs</div></div></a></div>');
				//console.log(datas.url);
			});
			$('#thubmnail-dev').slideDown(3000);
		});
		
	</script>
  </html>
  
