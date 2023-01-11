<?php
    session_start();
    
    $_SESSION['gender'] = "male"; 
    $_SESSION['userlevel'] = 1;
    $_SESSION['loggedIn'] = 0;
    $_SESSION['username'] =null;

    $username = null;
    $email    = null;
    $errors = array(); 
    $user_type = null;

    $db = mysqli_connect('localhost', 'root', '', 'assignment');

    // REGISTER USER
    if (isset($_POST['reg_user'])) 
    {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);

    // form validation
    if (empty($username)) 
    { 
        array_push($errors, "Username is required"); 
    }

    if (empty($email))
    { 
        array_push($errors, "Email is required");
    }
    
    if (empty($password_1))
    { 
        array_push($errors, "Password is required"); 
    }

    if($gender!='male'&& $gender!='female')
    {
        array_push($errors,"Gender is required");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // check the database to make sure a user does not exist with the same username/email
    
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user)
    { // if user exists
        if ($user['username'] === $username) 
        {
        array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) 
        {
        array_push($errors, "Email already exists");
        }
    }

    // register user if there are no errors in the form
    if (count($errors) == 0)
    {
        $password = md5($password_1);//encrypt the password
        if (strpos($_POST['username'],'admin') !== false) 
        {
            $user_type = 2;
            $query = "INSERT INTO users (username, email, password,gender,user_type) VALUES ('$username', '$email', '$password','$gender','$user_type')";
            mysqli_query($db, $query);
            $_SESSION['userlevel'] = $user_type;
            $_SESSION['gender'] = $gender;
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('location: maindashboard.php');
        }
        else
        {
            $user_type = 1;
            $query = "INSERT INTO users (username, email, password,gender,user_type) VALUES ('$username', '$email', '$password','$gender','$user_type')";
            mysqli_query($db, $query);
            $_SESSION['userlevel'] = $user_type;
            $_SESSION['gender'] = $gender;
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('location: maindashboard.php');				
        }
    }
    
    }
        // LOGIN USER
        if (isset($_POST['login_user'])) 
        {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
        
            if (empty($username)) {
                array_push($errors, "Username is required");
            }
            if (empty($password)) {
                array_push($errors, "Password is required");
            }
        
            if (count($errors) == 0) 
            {
                $password = md5($password);
                $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $results = mysqli_query($db, $query);
                $user = mysqli_fetch_assoc($results);
                if (mysqli_num_rows($results) == 1) 
                {
                    $_SESSION['userlevel'] = $user['user_type'];
                    $_SESSION['gender'] = $user['gender'];
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $user['username'];
                    header('location: maindashboard.php'); 
                }
                else 
                {
                    array_push($errors, "Wrong username/password combination");
                }
            }
        }  
?>