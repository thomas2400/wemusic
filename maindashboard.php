<html>
    <head>
        <title>Shoester Malaysia - Brand New Shoes</title>
        <link rel="stylesheet" href="style/mystyle.css">
        <link rel="stylesheet" href="style/Webstyle.css">
        <?php include 'connectdb.php';?>
        <?php include 'search.php';?>
    </head>

<body>
    <div id="main">
        <header>
            <?php 
                session_start();
                include 'includes/header.php';
            ?>
            <?php include 'includes/navigation.php';?>
        <header>
	<hr/>
    <button onclick="topFunction()" id="myBtn" title="Go to top">^</button>
        <marquee>***Free Shipping when spending over RM400!!! Terms and Condition Apply.***</marquee>
        <hr/>
        <br/>
        <div class="slideshow-container">
            <div class="mySlides">
                <a href='salesfootwear.php'>
                <img src="image/slideshow/202102_CNYSALES.jpg" alt="sales" width="100%">
                <div class="text"><a class="btn" href="salesfootwear.php">SHOP NOW</a></div>
                </a>
            </div>
            <div class="mySlides">
                <a href="shopfootwear.php?search=ultraboost">
                <img src="image/slideshow/202102_Week3UB21XL.jpg" alt="ultraboost" width="100%">
                <div class="text"><a class="btn" href="shopfootwear.php?search=ultraboost">SHOP ULTRABOOST</a></div>  
                </a>
            </div>
            <div class="mySlides">
                <a href="shopfootwear.php?brand=adidas">
                <img src="image/slideshow/202102Week3IvyParkXL.jpg" alt="adidas" width="100%">
                <div class="text"><a class="btn" href="shopfootwear.php?brand=adidas">SHOP ADIDAS X IVY PARK</a></div>
                </a>
            </div>
        </div>
        <br/>
        <div class="slideshow-dots" style="text-align:center;">
            <span class="dot" onclick="showSlides(0);clearTimeout(timer);"></span> 
            <span class="dot" onclick="showSlides(1);clearTimeout(timer);"></span> 
            <span class="dot" onClick="showSlides(2);clearTimeout(timer);"></span> 
        </div>

        <script>
            var timer = null;
            var slideIndex = 0;
            showSlides(slideIndex);

            

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                
                if(n!=undefined){slideIndex=n;}
                

                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                }
                slideIndex++;
                if (slideIndex > slides.length) {slideIndex = 1}    
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" actives", "");
                }
                //console.log(slideIndex);
                slides[slideIndex-1].style.display = "block";  
                dots[slideIndex-1].className += " actives";
                timer = setTimeout(showSlides, 5000); // Change image every 5 seconds   
            }
        </script>

        <div class="new-arrival-list">
                <h1 style="font-size: 23px; text-align: center;padding:30px 0px 10px 0px">NEW ARRIVALS</h1>
                <div class="new-arrival-container">
                    <?php 
                        $sql = "SELECT * FROM shoes ORDER BY Sid DESC LIMIT 5;";
                        $result = $connection->query($sql);
                        while($row = $result->fetch()) {
                            echo "
                            <div class='card'>
                            <a href='footwear.php?sid=".$row["Sid"]."'>
                            <img src='data:image/png;base64,".base64_encode( $row['Spic'] )."'/>
                            
                            ".$row["Sname"]."
                            </a>
                            </div>";}
                    ?>
                </div>
            <br>
            <div class="content">
                <div class="card-container">
                    <!-- card 1 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=air%20force">
                        <img src="image/main_dash_board/airforce1.jpg"/>
                        <div class="text"><a class="btn" href="shopfootwear.php?search=air%20force">SHOP AIR FORCE</a></div>
                        </a>
                    </div>
                    <!-- card 2 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=jordan">
                        <img src="image/main_dash_board/airjordan1.jpg"/>
                        <div class="text"><a class="btn" href="shopfootwear.php?search=jordan">SHOP AIR JORDAN</a></div>
                        </a>
                    </div>
                    <!-- card 3 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=air%20max">
                        <img src="image/main_dash_board/airmax.jpg"/>
                        <div class="text"><a class="btn"href="shopfootwear.php?search=air%20max">SHOP AIR MAX</a></div>
                        </a>
                    </div>
                    <!-- card 4 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=superstar">
                        <img src="image/main_dash_board/superstar.jpg"/>
                        <div class="text"><a class="btn" href="shopfootwear.php?search=superstar">SHOP SUPERSTAR</a></div>
                        </a>
                    </div>
                    <!-- card 5 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=ultraboost">   
                        <img src="image/main_dash_board/ultraboost.jpg"/>
                        <div class="text"><a class="btn" href="shopfootwear.php?search=ultraboost">SHOP ULTRABOOST</a></div>
                        </a>
                    </div>
                    <!-- card 6 -->
                    <div class="card">
                        <a href="shopfootwear.php?search=old%20skool">   
                        <img src="image/main_dash_board/oldskool.jpg"/>
                        <div class="text"><a class="btn" href="shopfootwear.php?search=old%20skool">SHOP OLD SKOOL</a></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php include 'includes/footer.php';?>

    <script>
        //Get the button
        var mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() 
        {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) 
            {
                mybutton.style.display = "block";
            } else 
            {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() 
        {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
</body>
</html>