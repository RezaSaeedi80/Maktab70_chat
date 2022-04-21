<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../output.css">
</head>
<body>
    
    <div class="container-all">
        <form action="../control/login.php" method="post" class="container-input">
            <?php if(isset($_GET['result'])) { $error = $_GET['result'];  ?>
            <div class="error">
                <span><?php echo $error ?></span>
            </div>
            <?php } ?>
            <div class="item"> 
                <label for="fname">Username:</label>
                <input type="text" name="Uname_log" id="fname" require>
            </div>
            <div class="item">
                <label for="pass">Password</label>
                <input type="password" name="password_log" id="pass" require>
            </div>
            <button class="btn" type="submit" id="ok" name="submit_login">Submit</button>
            <div class="link">
                <a href="register.php">Register</a>
            </div>
        </form>
    </div>

</body>
</html>