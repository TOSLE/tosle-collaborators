<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/04/2018
 * Time: 23:32
 */

class UserController
{
    public function indexAction($params)
    {
        echo "nothing";
    }

    public function connectAction($params)
    {
        $User = new UserRepository();
        $form = $User->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if(empty($errors)){
                if(isset($params["POST"]["email"]) && isset($params["POST"]["pwd"])){
                    if($User->verrifyUserLogin($params["POST"]["pwd"], $params["POST"]["email"])){
                        header("Location:" . DIRNAME);
                    } else {
                        $errors[AUTHENTIFICATION_FAILED_KEY] = AUTHENTIFICATION_FAILED_MESSAGE;
                    }
                }
            }
        }
        $View = new View("user", "User/connect");
        $registerMessage = "";
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'confirmed'){
                $View->setData('textConfirm', 'Accès confirmé');
            }
        }
        $View->setData('textConfirm', 'Accès confirmé');
        $View->setData("config", $form);
        $View->setData("errors", $errors);
    }

    public function registerAction($params) {
        $user = new User();
        $form = $user->configFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $user->setFirstName($params["POST"]["firstname"]);
                $user->setLastName($params["POST"]["lastname"]);
                $user->setEmail($params["POST"]["email"]); // voir pour le selectMultipleResponse + confirmEmail
                $user->setEmail($params["POST"]["emailConfirm"]);
                $user->setPassword($params["POST"]["pwd"]);
                $user->setPassword($params["POST"]["pwdConfirm"]);
                $user->setToken();
                $user->save();

                $email = $params["POST"]["email"];
                $firstName = $params["POST"]["firstname"];
                $lastName = $params["POST"]["lastname"];
                $token = $user->getToken();

                Mail::sendMailRegister($email, $firstName, $lastName,$token);
            }
        }
        $View = new View("user", "User/register");
        $registerMessage = "";
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'error'){
                $registerMessage = REGISTER_FAILED_MESSAGE;
            }
        }
        $View->setData('infoSignup', $registerMessage);
        $View->setData("config", $form);
        $View->setData("errors", $errors);

    }

    public function verifyAction($params)
    {
        $routes = Access::getSlugsById();

        if (isset($params["GET"]["email"]) && isset($params["GET"]["token"])) {
            $User = new User();

            $target = [/** Ce que l'on récupère lors de la requête (SELECT) **/
                "id"
            ];
            $parameter = [/** Les parametres pour la condition de la requête **/
                "LIKE" => [
                    "email" => $params["GET"]["email"],
                    "token" => $params["GET"]["token"]
                ]
            ];
            $User->setWhereParameter($parameter, null);
            $User->getOneData($target);
            if (!empty($User->getId())) {
                $User->setToken();
                $User->setStatus(1);
                $User->save();

                //blogcontroller

                $messConfirm = 'Inscription confirmé, vous pouvez vous connectez dès maintenant';
                header('Location:'.$routes["signin"].'/confirmed');
            } else {
                $messError = 'Inscription echoué, veuillez reesayer de vous inscrire.';
                header('Location:'.$routes["signup"].'/error');
            }
        }
    }

    public function disconnectAction($params)
    {
        header("Location:" . DIRNAME);
        $_SESSION["token"] = null;
        $_SESSION["email"] = null;
    }
}