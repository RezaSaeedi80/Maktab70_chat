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
        <form action="../control/register.php" method="post" class="container-input">
            <?php if(isset($_GET['result'])){ $result = $_GET['result'] ?>
            <div class="error">
                <span><?php echo $result ?></span>
            </div>
            <?php } ?>
            <div class="item">
                <label for="fname">Username:</label>
                <input type="text" name="Uname" id="fname" require>
            </div>
            <div class="item">
                <label for="lname">Full Name:</label>
                <input type="text" name="Fname" id="lname" require>
            </div>
            <div class="item">
                <label for="eAddress">Email:</label>
                <input type="email" name="email" id="eAddress" require>
            </div>
            <div class="item">
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" require>
            </div>
            <button class="btn" type="submit" id="ok" name="submit_register">Submit</button>
            <div class="link">
                <a href="login.php">login</a>
            </div>
        </form> 
    </div>
</body>    
</html>

<!-- npx tailwindcss -i ./chat_project/input.css -o ./chat_project/output.css --watch -->