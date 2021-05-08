<!DOCTYPE html>
<html>
    <head>
        <title>MARVEL : Characters</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="css/characters.css"/>
        <link rel="stylesheet" href="css/common.css"/>
        <link rel="icon" href="data/header_logo.png" type="image/x-icon">
        <script src="js/jquery.js"></script>
        <script src="js/characters.js"></script>
    </head>

    <body>
        <div class="display-error">
            <img src="data/background.jpg" height="100%"/>
        </div>

        <!-- Navigation Bar -->
        <div class="nav-bar">
                <a href="characters.php">Characters</a>
                <a href="movies.php">Movies</a>
                <a href="index.html" style="padding-top: 0px; padding-bottom: 0px;">
                        <img class="logo" src="data/Marvel-Logo.png" width=150px;/></a>
                <a href="tvshows.php">TV Shows</a>
                <a href="history.html">History</a>
        </div>       
        
        <!-- Search And drop down-->
        <div class="search-tools">
            <input type="search" class="search" placeholder="Whom you are looking for" 
                onkeydown="refreshContent();"/>
            <label class="search-label">

            <select id="sort-by" style=" height: 50px;
                            padding:0px;
                            margin:0px;
                            margin-left:30px;
                            border: none;
                            background-color:#111111;
                            color: #959595;
                            font-family: 'Roboto Condensed', sans-serif;
                            font-size: 20px;
                            padding: 10px;" onchange="refreshContent();">
                <option value="name">Name</option>
                <option value="energy">Energy</option>
                <option value="durability">Durability</option>
                <option value="strength">Strength</option>
            </select>
        </div>        

        <!--Card View characters-->
        <div class="wrap">
            <?php
                include_once 'php_bin/characterCardContent.php';
            ?>
        </div>
        
        <!-- footer -->
        <footer>
            <span>
                <svg viewBox="0 0 36 52" xmlns="http://www.w3.org/2000/svg"><rect fill="#EC1D24" width="100%" height="100%">
                    </rect><path fill="#FEFEFE" d="M31.5 48V4H21.291l-3.64 22.735L14.102 4H4v44h8V26.792L15.577 
                    48h4.229l3.568-21.208V48z"></path></svg>
            </span>
            <ul>
                <li><a id="icon" href="http://facebook.com/marvel"><img src="data/facebook.png"></a></li>
                <li><a id="icon" href="http://twitter.com/marvel"><img src="data/twitter.png"></a></li>
                <li><a id="icon"href="http://instagram.com/marvel"><img src="data/instagram.png"></a></li>
                <hr>
                <li><a href="https://disneytermsofuse.com/">Terms of Use</a></li>
                <li><a href="https://privacy.thewaltdisneycompany.com/en/">Privacy Policy</a></li>
                <li><a href="https://privacy.thewaltdisneycompany.com/en/current-privacy-policy/your-california-privacy-rights/">
                    Your California Privacy Rights</a></li>
                <li><a href="https://www.marvel.com/corporate/license_tou">License Agreement</a></li>
                <li><a href="http://preferences-mgr.truste.com/?pid=disney01&aid=marvel01&type=marvel">Interest-Based Ads</a></li>
                <li><a href="https://www.marvel.com/corporate/insider_terms">Marvel Insider Terms</a></li>
                <li>©2021 MARVEL</li>
                <hr>
                <li><p>Developed by <a href="https://www.github.com/TejaSrinivas01">A.Teja Srinivas</a></p></li>
            </ul>
        </footer>

    </body>
    <script type="text/javascript">
        function load_page(char_id){
            $.ajax({
                type: "GET",
                url: "php_bin/characterCardContent.php",
                data: "loadid="+char_id,
                success: function(result) {
                    $(".wrap").html(result);
                }
            });
        } 


    </script>
</html>