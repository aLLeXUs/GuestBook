<html>
    <head>
        <meta charset="utf-8">
        <title>Guest book</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
        
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
                <h2 class="form-signin-heading">Registration</h2>
                <label>Login:</label>
                <input type="text" class="form-control" name="login" placeholder="Login" value="<?=$_POST['login']?>" required autofocus>
                <label>Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <label>Password (Confirm):</label>
                <input type="password" class="form-control" name="password-confirm" placeholder="Password" required>
                <label>E-Mail:</label>
                <input type="email" class="form-control" name="email" placeholder="E-Mail" value="<?=$_POST['email']?>" required>
                <label>Name:</label>
                <input type="text" class="form-control" name="name" placeholder="Name" value="<?=$_POST['name']?>">
                <label>Country:</label>
                
                <div id="country">
                    <select class="form-control" name="country" required>
                        <option value="">Select country...</option>
                        <?php foreach ($gb->getCountries() as $key): ?>
                        <option value="<?=$key['id']?>"><?=$key['name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
 
                <div id="region" class="hidden">
                    <label>Region:</label>
                    <select class="form-control" name="region" required>
                        <option value="">Select region...</option>
                    </select>
                </div>

                <div id="city" class="hidden">
                    <label>City:</label>
                    <select class="form-control" name="city" required>
                        <option value="">Select city...</option>
                    </select>                   
                </div>
                
                <script>
                    
                    $(document).ready(function(){ 
                        $('#country select').change(function(){
                            $.ajax({
                                url: "ajax.php",
                                dataType: "json",            
                                data: {"mode": "city", "country": $(this).val()},
                                success: function(data){
                                    $('#region').removeClass("hidden");
                                    $('#city').addClass("hidden");
                                    $('#region select').empty();
                                    $('#city select').empty();
                                    $('<option value="">Select region...</option>').appendTo($("#region select"));
                                    for(var i=0;i<data.length;i++) 
                                    {
                                        $('<option value="'+data[i].id+'">'+data[i].name+'</option>').appendTo($("#region select"));
                                    }
                                }
                                });
                        });
                        
                        $('#region select').change(function(){
                            $.ajax({
                                url: "ajax.php",
                                dataType: "json",            
                                data: {"mode": "city", "region": $(this).val()},
                                success: function(data){
                                    $('#city').removeClass("hidden");
                                    $('#city select').empty();
                                    $('<option value="">Select city...</option>').appendTo($("#city select"));
                                    for(var i=0;i<data.length;i++) 
                                    {
                                        $('<option value="'+data[i].id+'">'+data[i].name+'</option>').appendTo($("#city select"));
                                    }
                                }
                                });
                        });
                    });
                
                </script>
                
                <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
                <a href="index.php" class="btn btn-lg btn-default btn-block">Back</a>
            </form>
            <?php endif; ?>
                    
        </div>
    </body>
</html>