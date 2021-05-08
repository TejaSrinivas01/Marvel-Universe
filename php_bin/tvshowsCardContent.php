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
	
	// 1. Show the cards card html code
	$show_card_split_1 = '<div class="show-card" onclick="load_page(';
	$show_card_split_1_1 = ');$(window).scrollTop(0);"><img src="';
    $show_card_split_2 = '"/><p class="show-name"><b>';
    $show_card_split_3 ='</b></p><p class="show-year">';
	$show_card_split_4 ='</p></div>';
	
	// 2. Expanded Card view
	$tvshow_content_1 = '<!DOCTYPE html>
	<html><head><style type="text/css">
		html{
			max-width: 100%;
			overflow-x: hidden;
		}
		body {
			background-color: black;
			color: white;
			max-width: 100%;
			overflow-x: initial; 
		}
		.mainTemplate {
			padding-left: 5px;
			padding-right: 5px;
			padding-top: 5px;
			position:relative;
		}
		.backgroundTemplate{
			margin: 0;
			padding: 0;
			height: 500px;
			width: 95%;
			object-fit: cover;
			position:relative;
			background-size: cover;
			padding-left: 20px;
			padding-right: 20px;
			padding-top: 20px;
		}
		.logo {
			height: 90px;
			width: 180px;
		}
		#tab1, #tab2, #tab3 {
			float: left;
			padding: 5px 10px 5px 10px;
			background: orangered;;
			color: white;
			margin: 0px 5px 0px 5px;
			cursor: pointer;
			border-radius: 5px;
		}
		#tab1:hover, #tab2:hover, #tab3:hover {
			background: red;
		}
		#tab1Content, #tab2Content, #tab3Content {
			position: relative;
			width:100%;
		}
		iframe{
			float:left;
			
		}
		.desc{
			position: absolute;
			top:100px;
			left:750px;
		}
			
		#tab1Content {
			display: block; 
		}
		p{
			font-size: 25px;
			line-height: 42px;
		}
		#tab2Content, #tab3Content {
			display: none; 
		}</style></head>
	<body><br><br>
		<center>
			<div class="mainTemplate">
				<div class="backgroundTemplate" style=" background: url(\'';
	$tvshow_content_2 = '\') no-repeat center/cover;"/>
			</div>
		</center>
		<br/><br/>
		<div class="trailer">
		<div id="tab1" onClick="JavaScript:selectTab(1);">Season 1</div>
		<div id="tab2" onClick="JavaScript:selectTab(2);">Season 2</div>
		<div id="tab3" onClick="JavaScript:selectTab(3);">Season 3</div>
		<br/><br/><br/>
		<div class="tabs">
			<div id="tab1Content" >
				<iframe width="693" height="390" src="';
	$tvshow_content_3 = '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				<p class="desc">';
	$tvshow_content_4 = '</p></div><div id="tab2Content"><iframe width="693" height="390" src="';
	$tvshow_content_5 = '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><p class="desc">';
	$tvshow_content_6 = '"</p></div><div id="tab3Content"><iframe width="693" height="390" src="';
	$tvshow_content_7 = '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><p class="desc">';
	$tvshow_content_8 = '"</p></div></div></div><br/><br/><br/><script>
		function selectTab(tabIndex) {
			document.getElementById("tab1Content").style.display="none";
			document.getElementById("tab2Content").style.display="none";
			document.getElementById("tab3Content").style.display="none";
			document.getElementById("tab" + tabIndex + "Content").style.display="block";  
		  }    
		</script>
	</body>
	</html>';

	
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
	$flag = 0;
	if(isset($_GET['search'])){
		$sortBy = $_GET["sort"];
        $content = $_GET["search"];
		$query1 =   "SELECT id,name,img_url,local_img_url,rel_year FROM tvshows where upper(name) like upper('%".$content."%') ORDER BY ".$sortBy;
        if($sortBy=='rel_year'){
            $query1 = $query1.' desc';
        }
		$flag = 0;
	}
	else if(isset($_GET['loadid'])){
		$tvshow_id = $_GET["loadid"];
		$query1 =   "SELECT id, name, wallpaper_url,local_wallpaper_url, link1,link2,link3,desc1,desc2,desc3 from tvshows where id = '".$tvshow_id."'";
		$current_page = 1;
		$flag = 1;
	}
    else{
		$query1 =   "SELECT id,name,img_url,local_img_url, rel_year FROM tvshows";
		$flag = 0;
    }
	$res_char = $conn->query($query1);
    
	// Show result to html
	if ($res_char->num_rows > 0) {
	    while($row = $res_char->fetch_assoc()) {
			if($flag == 1){
				echo $tvshow_content_1
					.$row["local_wallpaper_url"].$tvshow_content_2
					.$row["link1"].$tvshow_content_3
					.html_entity_decode($row["desc1"], ENT_QUOTES, "UTF-8").$tvshow_content_4
					.$row["link2"].$tvshow_content_5
					.html_entity_decode($row["desc2"], ENT_QUOTES, "UTF-8").$tvshow_content_6
					.$row["link3"].$tvshow_content_7
					.html_entity_decode($row["desc3"], ENT_QUOTES, "UTF-8").$tvshow_content_8;

			}
			else{
				echo $show_card_split_1
					.$row["id"].$show_card_split_1_1
					.$row["local_img_url"].$show_card_split_2
					.$row["name"].$show_card_split_3
					.$row["rel_year"].$show_card_split_4;
			}
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
?>