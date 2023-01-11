<html>
    <head>
        <title>Sales - Shoester Malaysia</title>
        <link rel="stylesheet" href="style/mystyle.css">
        <link rel="stylesheet" href="style/Webstyle.css">
        <link rel="stylesheet" href="style/category.css">
        <script>
            function openFootwearPage(sid){
                console.log(sid);
                window.location.href = "footwear.php?sid=" + sid;
            }
        </script>
        
        <?php
            include 'connectdb.php';

            // Create connection
            $connection = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // only display the current discount shoes (filtered expired and incoming)
            $currentTime = date("Y-m-d");
            
            $sql = "SELECT * From shoes RIGHT JOIN shoes_discount ON shoes.Sid = shoes_discount.Sid 
            AND shoes_discount.valid_from <= '$currentTime'AND shoes_discount.valid_until > '$currentTime'";
            // $sql .= " WHERE shoes_discount.valid_from <= '$currentTime' AND shoes_discount.valid_until > '$currentTime'";

            $category = null;
            $gender = null;
            $brand = null;
            
            if (isset($_GET['category'])) {
                $category = $_GET['category'];}
            if (isset($_GET['gender'])) {
                $gender = $_GET['gender'];}
            if (isset($_GET['brand'])) {
                $brand = $_GET['brand'];}

            {
                if($category == null && $gender == null && $brand == null)
                $sql .= " ";
                else if($category == null && $gender == null && $brand != null)
                $sql .= " WHERE Sbrand = '$brand'";
                else if($category == null && $gender != null && $brand == null)
                $sql .= " WHERE Sgender = '$gender'";
                else if($category == null && $gender != null && $brand != null)
                $sql .= " WHERE Sgender = '$gender' AND Sbrand = '$brand'";
                else if($category != null && $gender == null && $brand == null)
                $sql .= " WHERE Scategory = '$category'";
                else if($category != null && $gender == null && $brand != null)
                $sql .= " WHERE Scategory = '$category' AND Sbrand = '$brand'";
                else if($category != null && $gender != null && $brand == null)
                $sql .= " WHERE Scategory = '$category' AND Sgender = '$gender'";
                else if($category != null && $gender != null && $brand != null)
                $sql .= " WHERE Scategory = '$category' AND Sgender = '$gender' AND Sbrand = '$brand'";
            }

            $sorter = null;
            if (isset($_GET['sorter'])) {
                $sorter = $_GET['sorter'];
            }
            if($sorter=="latest") $sql.= " ORDER BY shoes_discount.Sid DESC";
            else if($sorter=="name-a-z") $sql.= " ORDER BY Sname";
            else if($sorter=="name-z-a") $sql.= " ORDER BY Sname DESC";
            else if($sorter=="price-low-high") $sql.= " ORDER BY discount_price";
            else if($sorter=="price-high-low") $sql.= " ORDER BY discount_price DESC";
            else if($sorter=="year-new-old") $sql.= " ORDER BY Syear DESC";
            else if($sorter=="year-old-new") $sql.= " ORDER BY Syear";

            
            $result = $connection->query($sql);

            if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
            }
        ?>
    </head>
    
    <body>

        <div id="main">
        <header class='header'>
            <?php 
                session_start();
                include 'includes/header.php';
            ?>
            <?php include 'includes/navigation.php';?>
        </header>
        <hr>
        <div class="container">
            <div class="side">
                <h3 class="heading">Filter</h3>
                
                <div class="filter-gender">
                    <h4 class="title">Gender</h4>
                    
                    <label class="checkbox-container" for="men">Men
                        <input type="checkbox" class="g-checkbox" id="men" name="gender" value="men" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="women">Women
                        <input type="checkbox" class="g-checkbox" id="women" name="gender" value="women" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="kids">Kids
                        <input type="checkbox" class="g-checkbox" id="kids" name="gender" value="kids" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="filter-category">
                    <h4 class="title">Category</h4>
                    
                    <label class="checkbox-container" for="basketball">Basketball
                        <input type="checkbox" class="c-checkbox" id="basketball" name="category" value="basketball" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="casual">Casual
                        <input type="checkbox" class="c-checkbox" id="casual" name="category" value="casual" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="running">Running
                        <input type="checkbox" class="c-checkbox" id="running" name="category" value="running" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="sandals-flipflops">Sandals & FlipFlops
                        <input type="checkbox" class="c-checkbox" id="sandals-flipflops" name="category" value="sandals-flipflops" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="skate-canvas">Skate & Canvas
                        <input type="checkbox" class="c-checkbox" id="skate-canvas" name="category" value="skate-canvas" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="filter-brand">
                    <h4 class="title">Brand</h4>
                    
                    <label class="checkbox-container" for="nike">Nike
                        <input type="checkbox" class="b-checkbox" id="nike" name="brand" value="nike" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="adidas">Adidas
                        <input type="checkbox" class="b-checkbox" id="adidas" name="brand" value="adidas" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="puma">Puma
                        <input type="checkbox" class="b-checkbox" id="puma" name="brand" value="puma" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="jordan">Jordan
                        <input type="checkbox" class="b-checkbox" id="jordan" name="brand" value="jordan" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="converse">Converse
                        <input type="checkbox" class="b-checkbox" id="converse" name="brand" value="converse" onclick="filter()"> 
                        <span class="checkmark"></span>
                    </label>
                    
                    <label class="checkbox-container" for="vans">Vans
                        <input type="checkbox" class="b-checkbox" id="vans" name="brand" value="vans" onclick="filter()">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <script>
                    document.getElementById("men").addEventListener('change', function() {
                        document.getElementById("women").checked = false;
                        document.getElementById("kids").checked = false;
                    })
                    document.getElementById("women").addEventListener('change', function() {
                        document.getElementById("men").checked = false;
                        document.getElementById("kids").checked = false;
                    })
                    document.getElementById("kids").addEventListener('change', function() {
                        document.getElementById("women").checked = false;
                        document.getElementById("men").checked = false;
                    })

                    document.getElementById("basketball").addEventListener('change', function() {
                        document.getElementById("casual").checked = false;
                        document.getElementById("running").checked = false;
                        document.getElementById("sandals-flipflops").checked = false;
                        document.getElementById("skate-canvas").checked = false;
                    })

                    document.getElementById("casual").addEventListener('change', function() {
                        document.getElementById("basketball").checked = false;
                        document.getElementById("running").checked = false;
                        document.getElementById("sandals-flipflops").checked = false;
                        document.getElementById("skate-canvas").checked = false;
                    })
                    document.getElementById("running").addEventListener('change', function() {
                        document.getElementById("casual").checked = false;
                        document.getElementById("basketball").checked = false;
                        document.getElementById("sandals-flipflops").checked = false;
                        document.getElementById("skate-canvas").checked = false;
                    })
                    document.getElementById("sandals-flipflops").addEventListener('change', function() {
                        document.getElementById("casual").checked = false;
                        document.getElementById("running").checked = false;
                        document.getElementById("basketball").checked = false;
                        document.getElementById("skate-canvas").checked = false;
                    })

                    document.getElementById("skate-canvas").addEventListener('change', function() {
                        document.getElementById("casual").checked = false;
                        document.getElementById("running").checked = false;
                        document.getElementById("basketball").checked = false;
                        document.getElementById("sandals-flipflops").checked = false;
                    })
                    
                    document.getElementById("nike").addEventListener('change', function() {
                        document.getElementById("adidas").checked = false;
                        document.getElementById("puma").checked = false;
                        document.getElementById("jordan").checked = false;
                        document.getElementById("converse").checked = false;
                        document.getElementById("vans").checked = false;
                    })
                    document.getElementById("adidas").addEventListener('change', function() {
                        document.getElementById("nike").checked = false;
                        document.getElementById("puma").checked = false;
                        document.getElementById("jordan").checked = false;
                        document.getElementById("converse").checked = false;
                        document.getElementById("vans").checked = false;
                    })

                    document.getElementById("puma").addEventListener('change', function() {
                        document.getElementById("adidas").checked = false;
                        document.getElementById("nike").checked = false;
                        document.getElementById("jordan").checked = false;
                        document.getElementById("converse").checked = false;
                        document.getElementById("vans").checked = false;
                    })
                    document.getElementById("jordan").addEventListener('change', function() {
                        document.getElementById("adidas").checked = false;
                        document.getElementById("puma").checked = false;
                        document.getElementById("nike").checked = false;
                        document.getElementById("converse").checked = false;
                        document.getElementById("vans").checked = false;
                    })
                    document.getElementById("converse").addEventListener('change', function() {
                        document.getElementById("adidas").checked = false;
                        document.getElementById("puma").checked = false;
                        document.getElementById("jordan").checked = false;
                        document.getElementById("nike").checked = false;
                        document.getElementById("vans").checked = false;
                    })
                    document.getElementById("vans").addEventListener('change', function() {
                        document.getElementById("adidas").checked = false;
                        document.getElementById("puma").checked = false;
                        document.getElementById("jordan").checked = false;
                        document.getElementById("converse").checked = false;
                        document.getElementById("nike").checked = false;
                    })
                </script>

                
                
                <script>
                    function filter(){
                        setTimeout(function(){
                            var checkedGenderValue = ""; 
                        var inputElements = document.getElementsByClassName('g-checkbox');
                        for(var i=0; inputElements[i]; ++i){
                            if(inputElements[i].checked){
                                checkedGenderValue = inputElements[i].value;
                                break;
                            }
                        }
                        var checkedCategoryValue = ""; 
                        inputElements = document.getElementsByClassName('c-checkbox');
                        for(var i=0; inputElements[i]; ++i){
                            if(inputElements[i].checked){
                                checkedCategoryValue = inputElements[i].value;
                                break;
                            }
                        }
                        var checkedBrandValue = ""; 
                        inputElements = document.getElementsByClassName('b-checkbox');
                        for(var i=0; inputElements[i]; ++i){
                            if(inputElements[i].checked){
                                checkedBrandValue = inputElements[i].value;
                                break;
                            }
                        }

                        window.location.href = "salesfootwear.php?gender="+checkedGenderValue+"&category="+checkedCategoryValue+"&brand="+checkedBrandValue;
                     
                    }, 200);
                        }
                
                </script>
                <?php
                    if($category!=null)
                    echo"<script>document.getElementById('".$category."').checked = true;</script>";
                    if($gender!=null)
                    echo"<script>document.getElementById('".$gender."').checked = true;</script>";
                    if($brand!=null)
                    echo"<script>document.getElementById('".$brand."').checked = true;</script>";   
                
                ?>
            </div>

            <div class="main">
                <?php echo" 
                <h3 class='heading'>SALE</h3>
                "?>
                <div class="shoe-sorter">
                    <p class="">Sort by </p>
                    <div class="select-sorter" style="width:150px;">
                        <select class="sorter" name="sorter" id="sorter" onchange="changeSorterFunc()">
                            <option value="default" <?php if($sorter == 'default'){echo("selected");}?>>Default</option>
                            <option value="latest" <?php if($sorter == 'latest'){echo("selected");}?>>Latest</option>
                            <option value="name-a-z" <?php if($sorter == 'name-a-z'){echo("selected");}?>>Name (A to Z)</option>
                            <option value="name-z-a" <?php if($sorter == 'name-z-a'){echo("selected");}?>>Name (Z to A)</option>
                            <option value="price-low-high" <?php if($sorter == 'price-low-high'){echo("selected");}?>>Price (Low to High)</option>
                            <option value="price-high-low" <?php if($sorter == 'price-high-low'){echo("selected");}?>>Price (High to Low)</option>
                            <option value="year-new-old" <?php if($sorter == 'year-new-old'){echo("selected");}?>>Year of model (New to Old)</option>
                            <option value="year-old-new" <?php if($sorter == 'year-old-new'){echo("selected");}?>>Year of model (Old to New)</option>
                        </select>
                    </div>
                </div>
                <script>
                    function changeSorterFunc(){
                        var select = document.getElementById("sorter");
                        var selectedSorter = select.value;
                        var x = location.href;
                        if(x.includes("?sorter")){
                            x=x.substring( 0, x.indexOf( "?sorter" ) );
                        }
                        else if(x.includes("&sorter")){
                            x=x.substring( 0, x.indexOf( "&sorter" ) );
                        }

                        if(x.includes("?")){
                            window.location.href = x + "&sorter="+selectedSorter;
                        }
                            
                        else 
                            window.location.href = x + "?sorter="+selectedSorter;
                    }




                </script>
                <hr/>
                <div class="products">
                    <div class="contianer">
                                <div class="product-items">
                                <?php
                                    if ($result->rowCount() > 0) {
                                    // output data of each row
                                    while($row = $result->fetch()) {
                                        echo "
                                        <!-- single product -->
                                        <div class='product'>
                                            <div class='product-content'>
                                                <div class='product-img'>
                                                    <a href='footwear.php?sid=".$row['Sid']."'>
                                                    <img src='data:image/png;base64,".base64_encode( $row['Spic'] )."' alt=''>
                                                    </a>
                                                </div>
                                                <div class='product-btns'>
                                                    <button type='button' class='btn-cart' onClick='openFootwearPage(".$row["Sid"].")'>add 
                                                    to cart</button>
                                                </div>
                                            </div>

                                            <div class='product-info'>
                                                <div class='product-info-top'>
                                                    <h2 class='sm-title'>".$row["Scategory"]."</h2>
                                                </div>
                                                <a href='footwear.php?sid=".$row["Sid"]."' class='product-name'>".$row["Sname"]."
                                                </a>
                                                <p class='product-price'id='discount'>RM".$row["Sprice"]."</p>
                                                <p class='product-price'>RM".$row["discount_price"]."</p>
                                            </div>

                                            <div class='off-info'>
                                                <h2 class='sm-title'>".number_format($row["discount_percent"],0)."% off</h2>
                                            </div>
                                        </div>
                                        <!-- end of single product -->
                                        ";
                                    }   
                                    } else {
                                        echo "0 results";
                                    }
                                    //close pdo connection
                                    $conn = null;
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include 'includes/footer.php';?>
    </body>
    
</html>