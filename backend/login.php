<?php 

require_once("config.php");
require_once("FormSanitizer.php");
require_once("constants.php");
require_once("account.php");

$account = new Account($con);

    if(isset($_POST["submitButton"])) {
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($username, $password);
        if($success) {
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }
function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name] ;
    }
}    

?>   
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bienvenue sur SimplonFix </title>
        <link rel="stylesheet" type="text/css" href="../assets/style/style.css" /> 
    </head>
    <body>
        <div class="signInContainer">
            <div class="column">
                <div class="header">
                    <img src="../assets/images/logo.png" title="Logo" alt="logoSimplonflix">
                    <h3>Enregistrez vous</h3>
                    <span>Pour continuer sur SimplonFlix</span>
                </div>
                <form method="POST">
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="username" placeholder="Pseudo" value="<?php getInputValue("username"); ?>" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>

                    <input type="submit" name="submitButton" value="SUBMIT">
                </form>
                <a href="register.php" class="signInMessage"> Vous n'avez pas de compte?</a>
            </div>

    </body>
</html>
