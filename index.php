<?php
// Mateo Pérez
// GR2SW
// 28-11-2022
$preferences = false;
$username = "";
$password = "";

if(isset($_COOKIE["c_preferences"]) && $_COOKIE["c_preferences"] != ""){
    $preferences = true;
    $username = isset($_COOKIE["c_username"])?$_COOKIE["c_username"]:"";
    $password = isset($_COOKIE["c_password"])?$_COOKIE["c_password"]:"";
}
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <h1>LOGIN</h1>
        <form method="POST" action="mipanel.php">
            <fieldset>
                Usuario*:<br>
                <input type="text" name="username" value="<?php echo $username?>"/><br>
                Password*:<br>
                <input type="password" name="password" value="<?php echo $password?>"/><br>
                <br>
                <input type="checkbox" name="preferences" <?php echo ($preferences)?"checked":""; ?> >Recordarme
                <br>
                <br>
                <input type="submit" value="Enviar">
            </fieldset>
        </form>
    </body>
</html>
