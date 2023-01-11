<html>

<head>
    <title>View Query</title>
    <link rel="stylesheet" href="style/mystyle.css">
    <link rel="stylesheet" href="style/Webstyle.css">

    <?php
        try
        {
             include 'connectdb.php';
             if(isset($_GET['id']))
             {
                 $id = $_GET['id'];
                 $sql = "SELECT CSID,name,phone,email,subject,description FROM contact_us WHERE CSID = '$id'";
                 $record = $connection->query($sql);
                 $record->setFetchMode(PDO::FETCH_ASSOC);
                 $data = $record->fetch();
             }
        }
        catch (PDOException $e)
        {
            echo "<script>alert('Error. Please try again');</script>";  
        }

    ?>
</head>

<body>
    <div id ="main">
            <?php 
                session_start();
                include 'includes/header.php';
            ?>
            <?php include 'includes/navigation.php';?>

            <div class="containerCS">
               <h1> View QUERY ID <?php echo $data['CSID'];?></h1>

               <br/>

               <p> From Customer : </p> <p id="data"><?php echo $data['name']; ?></p>

               <br/>

               <p> Contact Number:</p> <p id="data"><?php echo $data['phone']; ?> </p>

               <br/>

               <p> Email : </p> <p id="data"><?php echo $data['email']; ?></p>

               <br/>

               <p> Subject: </p> <p id="data"><?php echo $data['subject']; ?></p>

               <br/>

               <p> Description: </p>
               <p id="data"> <?php echo $data['description']; ?></p>

               <br/>
               <br/>

               <form action="mailto:<?php echo $data['email']; ?>" method="POST">
                    <button type="submit" name="reply" >Reply</button>
               </form>
            </div>
    </div>
    <?php include 'includes/footer.php';?>
</body>
</html>