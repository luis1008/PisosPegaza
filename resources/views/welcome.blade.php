<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo asset('fonts/style.css') ?>">
        <link rel="stylesheet" href="<?php echo asset('bootstrap4/css/bootstrap.min.css') ?>">
        <link rel="shortcut icon" href="<?php echo asset('img/WebIcono.png') ?>">
        <style>
            .login{
                width: 30%;
                margin: 0 0 0 35%;
            }

            button{
                width: 100%;
            }
        </style>
    </head>
    <body>
    <br>
    <br>
    
        <div class="container">
            <div class="row">
                <div class="text-center col">
                    <h4><b>Bienvenido al Sistema Administrativo Pegaza</b></h4>
                </div>
            </div>
            <center>  
            <div>  
                <img src="img/logo.jpg">
            </div>
            </center>
            <div class="login">
                <?php if(count($errors) > 0){ ?>
                    <div class="alert alert-danger">
                        <p class="text-center" style="margin-top:-10px;"><b>Error:</b></p>
                        <ul style="margin-top:-15px;">
                            <?php foreach($errors->all() as $error) { ?>
                                <li><?php echo $error ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                <form action="{{route('autentificacion')}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group col">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="icon icon-user"></span></span>
                            <input type="text" placeholder="USUARIO" name="usuario" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group col">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="icon icon-key"></span></span>
                            <input type="password" placeholder="PASSWORD" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group col text-right">
                        <button type="submit" class="btn btn-danger">Entrar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </body>
</html>
