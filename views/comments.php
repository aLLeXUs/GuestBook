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
            
            <?php if ($isAuthorized): ?>
            <div class="alert alert-info" role="alert">
                Signed in as: <b><?=$user['login']?></b><br>
                <a href="index?mode=logout">Logout</a>
            </div>
            
            <?php if ($isVerified): ?>

            <form class="form-comment" action="" method="POST">
                Subject: <input type="text" class="form-control" name="subject" value="<?= isError() ? htmlspecialchars($_POST['subject']) : '' ?>" required>
                Comment: <textarea class="form-control" name="text" rows="5" required><?= isError() ? htmlspecialchars($_POST['text']) : '' ?></textarea>
                <button class="btn btn-primary" type="submit">Post comment</button>
            </form> 
            
            <?php else: ?>
            
            <div class="alert alert-warning" role="alert">
                Для возможности комментирования нужно подтвердить почту <i><?=$user['email']?></i>. Для этого перейдите по ссылке в письме.<br>
                <a href="validation.php">Отправить еще раз</a><br>
            </div>
            
            <?php endif; ?>
            <?php endif; ?>
            
            <?php if ($showComments): ?>
            <?php foreach ($comments as $comment): ?>
            
            <blockquote>
                <b><?=$comment['subject']?></b>
                <p><?=$comment['text']?></p>
                <footer><b><?=$comment['login']?></b> <?=$comment['date']?></footer>
            </blockquote>
        
            <?php endforeach; ?>
            <?php endif; ?>
                    
        </div>
    </body>
</html>