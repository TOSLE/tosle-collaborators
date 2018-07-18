<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 15/05/2018
 * Time: 11:51
 */

class UserRepository extends User
{

    /**
     * @param string $password
     * @param string $email
     * @return integer|array
     * verrifyUserLogin va permettre de vérifier l'identification de l'utilisateur grâce au mot de passe et l'email en deux étapes
     */
    function verrifyUserLogin($password, $email)
    {
        $parameter = [
            "LIKE" => [
                "email" => $email
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["password"]);
        if(!empty($this->password)){
            if(password_verify($password, $this->password)){
                $target = [
                    "id",
                    "email",
                    "token",
                    "status"
                ];
                $parameter = [
                    "LIKE" => [
                        "email" => $email,
                        "password" => $this->password
                    ]
                ];
                $this->setWhereParameter($parameter);
                $this->getOneData($target);
                if(!empty($this->token) && !empty($this->email)){

                    if(empty($this->status))
                    {
                        return [AUTHENTIFICATION_FAILED_KEY => "Vous n'avez pas valider votre compte"];
                    }
                    else{
                        $this->setToken();
                        $this->setDateconnection();
                        $this->save();
                        $_SESSION['token'] = $this->token;
                        $_SESSION['email'] = $this->email;
                        return 1;
                    }
                }
            } else {
                return [AUTHENTIFICATION_FAILED_KEY => AUTHENTIFICATION_FAILED_MESSAGE];
            }
        } else {
           return [AUTHENTIFICATION_FAILED_KEY => AUTHENTIFICATION_FAILED_MESSAGE];
        }
    }
    function verrifyAuthentificationSession()
    {

    }

    public function getUser()
    {
        $target = ["id"];
        $parameter = [
            "LIKE" => [
                "token" => $_SESSION["token"],
                "email" => $_SESSION["email"]
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    public function getUserById($_id)
    {
        $target = [
            "id",
            "firstname",
            "lastname",
            "email",
            "status"
        ];
        $parameter = [
            "LIKE" => [
                "id" => $_id
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    public function getUserBySession($token, $email)
    {
        $target = [
            'firstname',
            'lastname',
            'email',
            'newsletter'
        ];
        $this->setWhereParameter(["LIKE" => [
            'token' => $token,
            'email' => $email,
        ]]);
        $this->getOneData($target);
    }

    /**
     * @return array
     * Retourne le tableau pour ajout du SELECT des utilisateurs dans un confirgForm
     */
    public function getSelectUsers()
    {
        $target = [
            'id',
            'firstname',
            'lastname'
        ];
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $this->setWhereParameter($parameter);
        $users = $this->getData($target);

        $option = [];
        foreach ($users as $user) {
            $option[$user->getId()] = $user->getLastname().' '.$user->getFirstname();
        }
        return [
            "select_users" => [
                "label" => "Ajouter des utilisateurs",
                "description" => "Vous avez le droit à plusieurs choix (\"CTRL + Clic\" pour réaliser un choix multiple)",
                "multiple" => true,
                "options" => $option
            ]
        ];
    }

    /**
     * @return array
     * Retourne le tableau pour ajout du SELECT des utilisateurs dans un confirgForm
     */
    public function getSelectSimpleUser($Auth = null)
    {
        $target = [
            'id',
            'firstname',
            'lastname'
        ];
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $this->setWhereParameter($parameter);
        $users = $this->getData($target);

        $option = [];
        foreach ($users as $user) {
            if($Auth->getId() != $user->getId()){
                $option[$user->getId()] = $user->getLastname().' '.$user->getFirstname();
            }
        }
        $return['select_user'] = [
            'label' => 'Choisir un destinataire',
            'required' => false,
            'options' => $option
        ];
        return $return;
    }
}