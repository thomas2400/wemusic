<html>
<head>
    <title>Update Query</title>
    <link rel="stylesheet" href="style/mystyle.css">
    <link rel="stylesheet" href="style/Webstyle.css">

    <?php
        try
        {
            include 'connectdb.php';
            $update = false;
            if(isset($_GET['csid']))
            {
                $id = $_GET['csid'];
                $sql = "SELECT CSID,name,phone,email,subject,status,date FROM contact_us WHERE CSID='$id'";
                $record = $connection->query($sql);
                $record->setFetchMode(PDO::FETCH_ASSOC);
                $data = $record->fetch();
            }
            
            if (isset($_POST['updatecs']))
            {   
                if(isset($_POST['status']))
                {
                    $status = $_POST['status'];
                    $sql = "UPDATE contact_us SET status='$status' WHERE CSID ='$id'";
                    $update = $connection->query($sql);
                }

                if($update)
                {
                    echo "<script>alert('succesfully updated the Query record with ID $id');";
                    echo "window.location ='adminpanel.php';</script>";
                }
                else{
                    echo "<script>alert('No changes made to this Query record with ID $id');";
                    echo "window.location ='adminpanel.php';</script>";
                }
            }
        }
        catch (PDOException $e)
        {
            echo "<script>alert('Error. Please try again');</script>";
            
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

            <h2> Update Query's Status <?php echo $_GET['csid'];?></h2>

            <div class = "containerCS">
                <form action="" method="POST">
                    <label>Query ID:</label>
                    <input type="text"  name="id"  value="<?php echo $data['CSID'];?>" readonly>

                    <label>Customer Name: </label>
                    <input type="text" name="name" value="<?php echo $data['name'];?>" readonly>

                    <label>Contact Number: </label>
                    <input type="text" name="contact" value="<?php echo $data['phone'];?>" readonly>

                    <label>Email : </label>
                    <input type="email" name="email" value="<?php echo $data['email'];?>" readonly>

                    <label>Subject : </label>
                    <input type="text" name="sub" value="<?php echo $data['subject'];?>" readonly>

                    <label>Status : </label>
                    <select name="status">
                        <option value="uncheck" <?php if($data['status']=="uncheck") echo 'selected="selected"'; ?>>uncheck</option>
                        <option value="checked" <?php if($data['status']=="checked") echo 'selected="selected"'; ?>>Checked</option>
                    </select>

                    <br/>
                    <br/>

                    <label>Date : </label>
                    <input type="text" name="date" value="<?php echo $data['date'];?>" readonly>
                    
                    <input type="submit" name="updatecs" value="Submit">
                </form>
            </div>

    </div>

    <?php include 'includes/footer.php';?>

</body>

</html>