<?php
ini_set('display_errors', '1'); //affiche les erreurs php
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once("config.php");
require_once("FormSanitizer.php");
require_once("constants.php");
require_once("account.php");

$account = new Account($con);

if(isset($_POST["submitButton"])) {
    
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);
    
    $success = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if($success) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bienvenue sur Simplonflix</title>
        <link rel="stylesheet" type="text/css" href="../assets/style/style.css" />
    </head>
    <body>
        
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="../assets/images/logo.png" title="Logo" alt="Site logo" />
                    <h3>Creez un compte</h3>
                    <span>pour continuer sur Simplonflix</span>
                </div>

                <form method="POST">

                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Prénom" value="<?php getInputValue("firstName"); ?>" required>

                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Nom" value="<?php getInputValue("lastName"); ?>"required>

                    <?php echo $account->getError(Constants::$userNameCharacters); ?>
                    <?php echo $account->getError(Constants::$userNameTaken); ?>
                    <input type="text" name="username" placeholder="Pseudo" value="<?php getInputValue("username");?>" required>

                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$invalidEm); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

                    <input type="email" name="email2" placeholder="Confirmez l'email" value="<?php getInputValue("email2"); ?>" required>

                    <?php echo $account->getError(Constants::$pwdsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>
                    <input type="password" name="password" placeholder="Mot de passe" value="<?php getInputValue("password"); ?>" required>

                    <input type="password" name="password2" placeholder="Confirmez le mot de passe" value="<?php getInputValue("password2"); ?>" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                    </form>

                <a href="login.php" class="signInMessage">Vous avez déjà un compte? enregistrez vous!</a>

            </div>

        </div>

    </body>
</html>