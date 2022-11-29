<?php
//var_dump($_POST);
//$language = (isset($_COOKIE["c_language"]))?$_COOKIE["c_language"]:"spanish";
session_start();
if(isset($_POST["username"]) && isset($_POST["password"])){
    $_SESSION["s_username"] = $_POST["username"];
    $_SESSION["s_password"] = $_POST["password"];
}

// Todas las páginas (de la zona VIP) controlan esto
if(!isset($_SESSION["s_username"]) && !isset($_SESSION["s_password"])) {
    header("Location: index.php");
}

// Lenguaje
if(isset($_GET["language"])) {
    $language = $_GET["language"];
}else{
    if(isset($_COOKIE["c_preferences"])) {
        $language = $_COOKIE["c_language"];
    }else{
        $language = "spanish";
    }
}

if(isset($_POST["preferences"])) {
    if(isset($_COOKIE["c_preferences"])){
        setcookie("c_language", $language, time()+(60*60*24));
    }else{
        $preferences = $_POST["preferences"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        setcookie("c_username", $username, time()+(60*60*24));
        setcookie("c_password", $password, time()+(60*60*24));
        setcookie("c_preferences", $preferences, time()+(60*60*24));
        setcookie("c_language", $language, time()+(60*60*24));
    }
}else if(isset($_POST["username"])) {
    setcookie("c_username","");
    setcookie("c_password", "");
    setcookie("c_preferences", "");
    setcookie("c_language");
} else{
    (isset($_COOKIE["c_preferences"]))?setcookie("c_language", $language, time()+(60*60*24)):"";
}
?>

<html>
    <head></head>
    <body>
        <h1>PANEL PRINCIPAL</h1>
        <h3>Bienvenido Usuario: <?php echo $_SESSION["s_username"]; ?></h3>
        <hr>
        <!– Se manda por parámetros en el GET –>
        <a href="mipanel.php?language=spanish">ES (Español) |</a><a href="mipanel.php?language=english"> EN (English)</a>
        <br>
        <a href="cerrarsesion.php">Cerrar Sesión</a>
        <?php 
            if($language == "spanish"){
                echo "<h2>Lista de Productos</h2>";
                $fileName = "categorias_es.txt"; 
            }else{
                echo "<h2>Product List</h2>"; 
                $fileName = "categorias_en.txt";
            }
            $file = fopen($fileName, "r");
            while (!feof($file)){
                $line = fgets($file);
                echo $line."<br>";
            }
            fclose ($file);
        ?>
    </body>
</html>
