<html>
    <head>
        <meta charset="utf-8">
        <title>Guest book</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        
        <!-- Custom styles for this template -->
        <link href="style/signin.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">

            <?php if ($needAlert): ?>
            <div class="alert alert-<?=$alert['type']?>" role="alert"><?=$alert['text']?></div>
            <?php endif; ?>
            
            <?php if ($needForm): ?> 
            <form class="form-signin" action="" method="POST">
                <h2 class="form-signin-heading">Sign In</h2>
                <input type="text" class="form-control" name="login" placeholder="Login" value="<?=$_POST['login']?>" required autofocus>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
                <a href="registration.php" class="btn btn-lg btn-default btn-block">Register</a>
            </form>  
            <?php endif; ?>  
                
        </div>
    </body>
</html>