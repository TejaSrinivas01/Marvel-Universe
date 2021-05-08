<?php
	$local_servername = "localhost";
	$local_username = "root";
	$local_password = "";
	$local_database = "marvel";
	
	// Heroku ClearDB Credientials
	$clearDB_servername = "us-cdbr-iron-east-05.cleardb.net";
	$clearDB_username = "b0c2244faae78b";
	$clearDB_password = "6f59158e";
	$clearDB_database = "heroku_a88504e8d77c8c5";
	
	//----------------------------------------------------
	// 1. For showing the content
	$movie_card_split_1 = '<div class="movie-card" onclick="load_page(';
	$movie_card_split_1_1 = ');$(window).scrollTop(0);"><img src="';
    $movie_card_split_2 = '"/><p class="movie-name"><b>';
    $movie_card_split_3 ='</b></p><p class="movie-year">';
    $movie_card_split_4 ='</p></div>';
	
	// 2. Showing perticular page
	$return_page_1 = '<!DOCTYPE html><html><head><style type="text/css">
			@import url("https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap");
			body {
				background-color: black;
				color: white;
				font-family: "Roboto Condensed", sans-serif;
				max-width: 100%;
				overflow-x: initial;
				padding: 0;
				margin: 0;
			}
			.mainTemplate {
				position:relative;
			}
			.backgroundTemplate{
				height: 800px;
				width: 100%;
				position: absolute;
				top: 0;
				right:0;
				object-fit: cover;
				position:relative;
				background-size: cover;
			}
			.logo {
				height: 90px;
				width: 180px;
			}
			iframe{
				height: 500px;
				width: 85%;
				object-fit: cover;
				background-size: cover;
				padding-left: 20px;
				padding-right: 20px;
				padding-top: 20px;
			}
			.image-header {
				padding-left: 20px;
				font-size:xx-large;
			}
			.header{
				text-decoration: azure;
				margin:30px;
				
			}
			.desc{
				margin:30px;
			}
			.name{
				font-weight: bolder;
			}
			.main-content{
				padding: 5px;
				background-color:#383838;
				height: 100%;
				width:100%;
			}
			.content{
				position:relative;
				margin:30px;
			}
			.label{
				position: absolute;
			}
			.label1{
				position: absolute;
				top:0;
				left:0;
			}
			.label2{
				position: absolute;
				top:0;
				right:0;
			}
			.label3{
				position: absolute;
				bottom:20;
				left:0;
			}
			.label4{
				position: absolute;
				bottom:20;
				right:0;
			}
			.label5{
				position: absolute;
				bottom:50;
				left:0;
			}
		</style>
	</head>
	<body><br><br>
		<center>
			<div class="mainTemplate" style="width:100%;">
				<img class="backgroundTemplate" src="';
		$return_page_2 = '"/></div></center><br><br><h2 class="image-header">Trailer</h2><center>
		<iframe height: 500px;width: 95%; src="';
		$return_page_2_1 = '" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</center><br><br><div class="main-content"><h1 class="header">Synopsis</h1><br><div class="desc">';

		$return_page_3 = '</div><br><div class="content"><div class="labels"><div class="label1"><div class="name">Directors</div><div class="value">';
		$return_page_4 = '</div></div><br><br><div class="label2"><div class="name">Written By</div><div class="value">';
		$return_page_5 = '</div></div><br><br><div class="label3"><div class="name">Rating</div><div class="value">';
		$return_page_6 = '</div></div><br><br><div class="label4"><div class="name">Run Time</div><div class="value">';
		$return_page_7 = '</div></div><br><br><div class="label5"><div class="name">Release Date</div><div class="value">';
		$return_page_8 = '</div></div><br><br><br></div></div></div></body></html>';


	// Connection Handling
	error_reporting(0);
	$conn = new mysqli($clearDB_servername, $clearDB_username, $clearDB_password, $clearDB_database);
	if ($conn->connect_error) {
		$conn = new mysqli($local_servername, $local_username, $local_password, $local_database);
		if ($conn->connect_error){
			echo "Error : Local Server Not Running";
		}
	}

	// This is used to tell mysql server that send only the 'UTF-8' Characterset.
	mysqli_set_charset($conn, "utf8");

	// Request an Query
	$current_page = 0;
	if(isset($_GET['search'])){
		$sortBy = $_GET["sort"];
        $content = $_GET["search"];
		$query1 =   "SELECT id,name,img_url,local_img_url, rel_year,runtime FROM movies where upper(name) like upper('%".$content."%') ORDER BY ".$sortBy;
        if($sortBy=='rel_year' || $sortBy=='runtime'){
            $query1 = $query1.' desc';
        };
		$current_page = 0;
	}
	else if(isset($_GET['loadid'])){
		$movie_id = $_GET["loadid"];
		$query1 =   "SELECT id,name,wallpaper_url, local_wallpaper_url, trailer_url,synopsis,director,writer,rating,rel_date, runtime
					FROM movies where id = '".$movie_id."'";
		$current_page = 1;
	}
    else{
		$query1 = "SELECT id,name,img_url,local_img_url, rel_year FROM movies";
		$current_page = 0;
	}
	
	$res_char = $conn->query($query1);
    
	// Show result to html
	if ($res_char->num_rows > 0) {
	    while($row = $res_char->fetch_assoc()) {
			if ($current_page == 0){
				echo $movie_card_split_1
				.$row["id"].$movie_card_split_1_1
                .$row["local_img_url"].$movie_card_split_2
                .$row["name"].$movie_card_split_3
				.$row["rel_year"].$movie_card_split_4;
			}
			else if($current_page == 1){
				echo $return_page_1
				.$row["local_wallpaper_url"].$return_page_2
				.$row["trailer_url"].$return_page_2_1
				.$row["synopsis"].$return_page_3
				.$row["director"].$return_page_4
				.$row["writer"].$return_page_5
				.$row["rating"].$return_page_6
				.$row["runtime"].$return_page_7
				.$row["rel_date"].$return_page_8;
			}
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
?>