<html>
<head>
    <title>Edit Blog</title>
    <link rel="stylesheet" href="style/mystyle.css">
    <link rel="stylesheet" href="style/Webstyle.css">

    <?php
            include 'connectdb.php';
            $update = false;
            if(isset($_GET['bid']))
            {
                $id = $_GET['bid'];
                $sql = "SELECT * from blog WHERE id = $id";
                $record = $connection->query($sql);
                $record->setFetchMode(PDO::FETCH_ASSOC);
                $data = $record->fetch();
            }
            
            if (isset($_POST['update']))
            {   
                if(isset($_POST['Aname']) && isset($_POST['category']) && isset($_POST['headline']) && isset($_POST['intro']) && isset($_POST['main']) && isset($_POST['subh']) && isset($_POST['conclusion']) && isset($_POST['date']))
                    {
                        $author = $_POST['Aname'];
                        $cate = $_POST['category'];
                        $head = $_POST['headline'];
                        $intro = $_POST['intro'];
                        $main = $_POST['main'];
                        $subh = $_POST['subh'];
                        $con = $_POST['conclusion'];
                        $date = $_POST['date'];
                    $sql = "UPDATE blog SET Author='$author',Category='$cate',Headline='$head',Introduction ='$intro', Main='$main', SubHeadline='$subh', Con='$con', Date='$date' where id ='$id'";
                    $update = $connection->query($sql);
                }

                if($update)
                {
                    echo "<script>alert('succesfully updated the record with Blog $id');";
                    echo "window.location ='adminpanel.php';</script>";
                }
                else{
                    echo "<script>alert('No changes made to this record with Blog $id');";
                    echo "window.location ='adminpanel.php';</script>";
                }
            }
      
    ?>

</head>

<body>
    <div id="main">
            <?php 
                session_start();
                include 'includes/header.php';
            ?>
            <?php include 'includes/navigation.php';?>

            <h2> Edit Blog detail <?php echo $_GET['bid']?></h2>

            <div class = "containerCS">
            <form method="POST" enctype="multipart/form-data">
                        <label>Author: </label>
                        <input type="text" name="Aname" value="<?php echo $data['Author'];?>">

                        <label>Category: </label><br/>
                        <select name = "category">
                            <option value ="FootCare" <?php if($data['Category']=="FootCare") echo 'selected="selected"'; ?>> FootCare</option>
                            <option value ="Men" <?php if($data['Category']=="Men") echo 'selected="selected"'; ?>> Men</option>
                            <option value ="Women" <?php if($data['Category']=="Women") echo 'selected="selected"'; ?>> Women</option>
                        </select>

                        <br/>
                        <br/>
                        
                        <label> Headline: </label><br/>
                        <input type="text" name="headline" value="<?php echo $data['Headline'];?>">
                        
                        <br/>
                        <br/>

                        <label> Introduction: </label><br/>
                        <textarea id ="intro" name="intro"><?php echo $data['Introduction'];?></textarea>

                        <br/>
                        <br/>

                        <label>Main:</label><br/>
                        <textarea id="maincontent" name="main"><?php echo $data['Main'];?></textarea>

                        <br/>
                        <br/>

                        <label>Sub-Headline:</label><br/>
                        <textarea id="subh" name="subh"><?php echo $data['SubHeadline'];?></textarea>

                        <br/>
                        <br/>

                        <label>Conclusion:</label><br/>
                        <textarea id="conclusion" name="conclusion"><?php echo $data['Con'];?></textarea>

                        <br/>
                        <br/>

                        <label>Date:</label>
                        <input type="date" name="date" value="<?php echo $data['Date'];?>" required="required">

                        <br/>
                        <br/>

                        <input type="submit" name="update">  
                </form>
            </div>

    </div>

    <?php include 'includes/footer.php';?>

</body>

</html>