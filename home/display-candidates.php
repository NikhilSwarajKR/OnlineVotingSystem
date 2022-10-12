<?php
include './includes/nav_bar.php'; 
?>
<div class="content">

</div>
<div class="image" hidden>
	<img src="./image_sources/candid_pic.jpg" >
</div>
<script>
	$(document).ready(function() {
		$.ajax({
			url: "./includes/get_display_data.php",
			method: "GET",
			success: function(data) {
				data = $.parseJSON(data);
				var pos_id = [],pos_name = [];
				for (var i in data) {
					pos_id.push(data[i].id);
					pos_name.push(data[i].position_name);
				}
				var pos_id = Array.from(new Set(pos_id));
				var pos_name = Array.from(new Set(pos_name));
				for (var i in pos_id) {
					var posName=pos_name[i].trim().split(" ").join("");
					$('.content').append('<h1>'+pos_name[i]+' post</h1>');
					var html = '<div id="'+posName+'" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
					for (var j in data) {
						if (pos_id[i] == data[j].id) {
							var image, name;
							if (data[j].photo == "") {
								image = "profile.jpg";
							} else {
							image = data[j].photo;
							}
							name = data[j].firstname + " " + data[j].lastname;
							html = html + ' <div class="carousel-item "><img src="../images/' + image + '"  style="border-radius:5px; class="rounded-circle" ><div class="details"><h3>'+name+'</h3><p>'+data[j].description+'</p></div></div>';
						}
					}
					html = html + '</div><button class="carousel-control-prev" type="button" data-target="#'+posName+'" data-slide="prev"><span class="carousel-control-prev-icon" class="rounded-circle" aria-hidden="true"></span><span class="visually-hidden"></span></button><button class="carousel-control-next" type="button" data-target="#'+posName+'" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden"></span></button></div>';
					$('.content').append(html);
				}
				$('.carousel-inner').each(function(){
					$(this).children().first().addClass('active');
					$('.image').attr('hidden',false);
				});
					
			},
			error: function(data) {
				console.log(data);
			}
		});
  		$('nav ul li a').eq(2).addClass("active");
		$('.carousel').carousel({
			interval:2000
		});
});
</script>

<style> 
	.image img {
		top: 50px;
		position: fixed;
		z-index: -1;
		width: 100%;
		height: 100vh;
		margin: 0px;
	}
	h1{
		color: white;
		text-align: center;
		text-transform: uppercase;
		margin-bottom:35px;
		margin-top: 10px;
	}
	.carousel{
		background-color: rgba(0,0,9,.6);
		border-radius: 5px;
		height: 380px;
		width: 95%;
		margin: 20px;
		padding:20px;
	}
	.carousel-control-prev ,.carousel-control-next{
		border: none;
		border-radius: 5px;
		padding: 15px;
		width: 80px;
		background-color: rgba(0,0,9,.8);
	}
	.carousel-control-prev-icon,.carousel-control-next-icon{
		border-radius: 15px;
		padding: 25px;
	}
	.carousel img{
		margin: 50px;
		float: left;
		height:200px; 
		width:200px;
		margin-left: 80px;
	}
	.details{
		color:white;
		text-align: center;
		padding: 20px;
	}
	.details h3{
		text-transform: uppercase;
	}
	.details p{
		font-size: 20px;
		font-style: italic;
		padding: 10px;
		margin-right: 80px;
	}
	@media all and (max-width:1100px){
		h1{
			font-size: 25px;
			margin-bottom:15px;
			margin-top: 15px;
		}
		.carousel{
			background-color: rgba(0,0,9,.6);
			border-radius: 5px;
			height: 300px;
			width: 100%;
			margin: 0px;
			padding:20px;
			overflow-y: scroll;
		}
		.carousel-control-prev ,.carousel-control-next{
			padding: 10px;
			width: 40px;
		}
		.carousel-control-prev-icon,.carousel-control-next-icon{
			border-radius: 15px;
			padding: 15px;
		}
		.carousel img{
			margin: 10px;
			float: left;
			height:100px; 
			width:100px;
			margin-left: 35px;
			margin-bottom: 0px;
		}
		.details{
			color:white;
			text-align: center;
			padding: 20px;
		}
		.details h3{
			font-size: 18px;
		}
		.details p{
			font-size: 12px;
			padding: 10px;
			margin-right: 0px;
		}
	}
</style>
</body>
