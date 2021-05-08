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
    
	$card_split_1 = "<div class=\"card\"><div class=\"front side\" style=\"background-image: url('";
	$card_split_2 = '\')")>
                    <div class="content front-text">
                        <h1>';
	$card_split_3 = '</h1>
                    </div>
                </div>
            
                <div class="back side">
                    <div class="content back-text">
                        <h1>Skills</h1>
                        <ul>
                            <li>Energy
                                <div class="horizontal rounded">
                                        <div class="progress-bar horizontal">
                                            <div class="progress-track">
                                                <div class="progress-fill" style="width:';

    $card_split_4 =     '%;">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>Durability
                                <div class="horizontal rounded">
                                        <div class="progress-bar horizontal">
                                            <div class="progress-track">
                                                <div class="progress-fill" style="width:';
    $card_split_5 = '%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </li>
                            <li>Strength
                                <div class="horizontal rounded">
                                    <div class="progress-bar horizontal">
                                        <div class="progress-track">
                                            <div class="progress-fill" style="width: ';
    $card_split_6 = '%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <button onclick="load_page(';
    $card_split_7 = ');$(window).scrollTop(0);">&gt</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>';


    // 2. show character description
    $char_expand_1 = '<!DOCTYPE html><html><head><style type="text/css">
            html{
                max-width: 100%;
                overflow-x: hidden;
            }
            body {
                background-color: black;
                color: white;
                max-width: 100%;
                overflow-x: initial;
                margin: 0;
                padding: 0;
                
            }
            .mainTemplate {
                position:relative;
            }
            .backgroundTemplate{
    
                height: 500px;
                width: 95%;
                position:sticky;
                background-size: cover;
            }
            .name {
                text-decoration: underline;
                text-decoration-color: red;
                font-size:45px;
                font-weight:400;
            }
            .info {
                color:white;
                position: absolute;
                right:100px;
                bottom: 80px;
                width: 400px;
                height: 40%;
                text-decoration:solid;
                
            }
            p{
                font-size:15pt;
            }
            .image-header {
                padding-left: 20px;
                font-size:40pt;
            }
            .images {
                text-align:center !important;
                align-items: flex-start;;
                position: relative;
                display: inline-block;
                
            }
            .SM {
                width: 100%;
            }
            .Powers {
                width: 100%;
            }
            .left-button{
                margin: 2;
                padding: 4;
                background-color: gray;
                position: absolute;
                left:0;
                display: inline-block;
            }
            .right-button{
                margin: 2;
                padding: 4;
                background-color: gray;
                position: absolute;
                right:0;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <br><br>
        <center>
            <div class="mainTemplate">
                <div class="backgroundTemplate" style=" background-image: url(\'';
        $char_expand_2 = '\');"/>
                <aside class="info">
                    <h1 class="name"><b>';
        $char_expand_3 = '</b></h1>
                    <p>';
        $char_expand_4 = '</p>
                </aside>
            </div>
        </center>
        <center>
        <h2 class="image-header">Story Moments</h2>
        <div class="images">';
        $char_expand_5 ='
            <button class="left-button" onclick="plusDivsSM(-1)">&#10094;</button>
            <button class="right-button" onclick="plusDivsSM(1)">&#10095;</button>
        </div>
        </center>
        <br /><br />
        <center>
        <h1 class="image-header">Powers</h1>
        <div class="images">';
        $char_expand_6 ='
            <button class="left-button" onclick="plusDivsPower(-1)">&#10094;</button>
            <button class="right-button" onclick="plusDivsPower(1)">&#10095;</button>
        </div>
        </center>
        <script type="text/javascript">
            var smIndex = 1;
            showDivsSM(smIndex);
            
            function plusDivsSM(n) {
                showDivsSM(smIndex += n);
            }
            function showDivsSM(n) {
                var i;
                var x = document.getElementsByClassName("SM");
                if (n > x.length) { smIndex = 1 }
                if (n < 1) { smIndex = x.length }
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[smIndex - 1].style.display = "block";
            }
            var powerIndex = 1;
            showDivsPower(powerIndex);
            
            
            function plusDivsPower(n2) {
                showDivsPower(powerIndex += n2);
            }
            
            function showDivsPower(n2) {
                var i;
                var y = document.getElementsByClassName("Powers");
                if (n2 > y.length) { powerIndex = 1 }
                if (n2 < 1) { powerIndex = y.length }
                for (i = 0; i < y.length; i++) {
                    y[i].style.display = "none";
                }
                y[powerIndex - 1].style.display = "block";
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
    
    $flag = 0;
    $char_id = 1;
	// Request an Query
	if(isset($_GET['search'])){
        $sortBy = $_GET["sort"];
        $content = $_GET["search"];
        $query1 =   "SELECT c.id,name,img_url,local_img_url, durability, strength, energy 
                    FROM characters c, skills s where c.id = s.id 
                    and upper(c.name) like upper('%".$content."%')
                    ORDER BY ".$sortBy;
        if($sortBy=='energy' || $sortBy == 'durability' || $sortBy == 'strength'){
            $query1 = $query1.' desc';
        }
        $flag = 0;
    }
    else if(isset($_GET['loadid'])){
		$char_id = $_GET["loadid"];
		$query1 = "SELECT id, name, char_desc, wallpaper_url, local_wallpaper_url FROM characters where id ='".$char_id."'";
		$current_page = 1;
        $flag = 1;
	}
    else{
        $query1 =   "SELECT c.id,name,img_url, local_img_url, durability, strength, energy 
                    FROM characters c, skills s where c.id = s.id";
        $flag = 0;
    }
    $res_char = $conn->query($query1);
    
	// Show result to html
	if ($res_char->num_rows > 0) {
	    while($row = $res_char->fetch_assoc()) {
            if($flag==0){
                echo $card_split_1
                    .$row['local_img_url'].$card_split_2
                    .$row['name'].$card_split_3
                    .$row['durability'].$card_split_4
                    .$row['strength'].$card_split_5
                    .$row['energy'].$card_split_6
                    .$row['id'].$card_split_7;
            }
            else{
                // Preparation
                //1. STORY MOMENT
                $num_img = 5;
                if($char_id==13 ||$char_id==4 ||$char_id==9 ||$char_id==5 ||$char_id==3||$char_id==6){
                    $num_img = 4;
                }
                $story_moment_str = '';
                for($i=1; $i <= $num_img; $i++ ) {
                    $story_moment_str = $story_moment_str.'<img class="SM" src="data/StoryMoments/'.$row['name'].'/'.$i.'.png"/>';
                }

                // 2. Power
                $num_img = 4;
                if($char_id==9 ||$char_id==1){
                    $num_img = 3;
                }
                else if($char_id==5 ||$char_id==2 ||$char_id==8 ||$char_id==15){
                    $num_img = 5;
                }

                $power_str = '';
                for($i=1; $i <= $num_img; $i++ ) {
                    $power_str = $power_str.'<img class="Powers" src="data/Powers/'.$row['name'].'/'.$i.'.png"/>';
                }

                // echo output
                echo $char_expand_1
                    .$row['local_wallpaper_url'].$char_expand_2
                    .$row['name'].$char_expand_3
                    .$row['char_desc'].$char_expand_4
                    .$story_moment_str.$char_expand_5
                    .$power_str.$char_expand_6;
            }
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
?>