<html>
<head>
    <title>Update FAQ</title>
    <link rel="stylesheet" href="style/mystyle.css">
    <link rel="stylesheet" href="style/Webstyle.css">

    <?php
            include 'connectdb.php';
            $update = false;
            if(isset($_GET['FID']))
            {
                $id = $_GET['FID'];
                $sql = "SELECT * from faq WHERE FID = $id";
                $record = $connection->query($sql);
                $record->setFetchMode(PDO::FETCH_ASSOC);
                $data = $record->fetch();
            }
            
            if (isset($_POST['update']))
            {   
                if(!empty($_POST['category']) && isset($_POST['question']) && isset($_POST['answer']))
                {
                    $question = $_POST['question'];
                    $answer = $_POST['answer'];
                    $category = $_POST['category'];
                   
                    $sql = "UPDATE faq SET Fcate='$category', Fquestion ='$question', Fanswer='$answer' where FID =$id";
                    $update = $connection->query($sql);
                }
                else if(empty($_POST['question']) || empty($_POST['answer']))
                {
                    echo "<script>alert('all field cannot be blank!');</script>";
                }

                if($update)
                {
                    echo "<script>alert('succesfully updated the record with FAQ ID $id');";
                    echo "window.location ='adminpanel.php';</script>";
                }
                else{
                    echo "<script>alert('No changes made to this record with FAQ ID $id');";
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

            <h2> Edit FAQ <?php echo $_GET['FID']?></h2>

            <div class = "containerCS">
                <form action="" method="POST">
                        <label>Category: </label><br/>
                        <select name="category">
                            <option value="ORDER-DELIVERY"<?php if($data['Fcate']=="ORDER-DELIVERY") echo 'selected="selected"'; ?>>ORDER-DELIVERY</option>
                            <option value="PRODUCT-STOCK"<?php if($data['Fcate']=="PRODUCT-STOCK") echo 'selected="selected"'; ?>>PRODUCT-STOCK</option>
                            <option value="RETURNS"<?php if($data['Fcate']=="RETURNS") echo 'selected="selected"'; ?>>RETURNS</option>
                        </select>

                        <br/>
                        <br/>

                        <label>Question: </label>
                        <textarea name="question" value=""><?php echo $data['Fquestion'];?></textarea>

                        <br/>
                        <br/>

                        <label>Answer: </label>
                        <textarea name="answer" value=""><?php echo $data['Fanswer'];?></textarea>

                        <input type="submit" name="update" value="Submit">
                </form>
            </div>

    </div>

    <?php include 'includes/footer.php';?>

</body>

</html>