<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1">
            <h2 class="text-center">Login</h2>
            <form class="login" action="<?=_setUrl('login/valida');?>" method="post" >

                <div class="login-form">
                    <label class="lavllo" for="login-name">Usuario:</label>
                    <div class="form-group">
                        <input type="text" class="form-control login-field" value="<?=$_ERROR['user']?>" name="user" placeholder="Ingresa tu usuario" id="login-name" >
                        <label class="login-field-icon fui-user" for="login-name"></label>
                    </div>
                    <label class="lavllo" for="login-pass">Password:</label>
                    <div class="form-group">
                        <input type="password" class="form-control login-field" value="<?=$_ERROR['pass']?>" name="password" placeholder="Ingresa tu Password" id="login-pass">
                        <label class="login-fielmdd-icon fui-lock" for="login-pass"></label>
                    </div>
                    <?php if($_ERROR){?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>
                            Error!<br>
                        </strong>
                        <?=$_ERROR['mensaje']?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true" >&times;</span>
                        </button>
                    </div>
                    <?php }?>
                    <button class="btn btn-primary btn-lg btn-block" >Ingresar</button>
                    <a class="login-link" href="#">Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>
</div>


