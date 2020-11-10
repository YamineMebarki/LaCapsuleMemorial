<?php

class users extends database {

    public $mailconnect = '';
    public $id = 0;
    public $lastname = '';
    public $firstname = '';
    public $pass = '';
    public $mail = '';
    public $id_ya_role = 0;
    public $id_ya_users = 0;
    public $nbUsers = '';
    public $tokenUser = '';
    public  $adresse = '';
    public  $datehour = '';
    public $city = '';
    public $postalCode = '0000';
    public $success = false;
    /**
     * Method construct qui ce connecte a ma base de données
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method qui permet d'inserer un paiement en base
     * @return type bool
     */
    public function insertPaypal() {
        $update = 'INSERT INTO `ya_paypal` (`adresse`, `postal_code`, `datehour`, `city`, `id_ya_users`) VALUES(:adresse, :postal_code, :datehour, :city, :id_ya_users)';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':adresse', $this->adresse, PDO::PARAM_STR);
        $updateDb->bindValue(':postal_code', $this->postalCode, PDO::PARAM_STR);
        $updateDb->bindValue(':city', $this->city, PDO::PARAM_STR);
        $updateDb->bindValue(':datehour', $this->datehour, PDO::PARAM_STR);
        $updateDb->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        return $updateDb->execute();
    }

    /**
     * method qui permet  d'enregistrer la confirmation  paypal
     * @return bool
     */
    public function updatePaypal() {
        $query = 'UPDATE `ya_paypal` SET `success`=:success WHERE `id_ya_users`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $findProfil->bindValue(':success', $this->success, PDO::PARAM_STR);
        return $findProfil->execute();
    }

    public function getPaypal() {
        $query = 'SELECT `success` FROM `ya_paypal` WHERE `id_ya_users`= :id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $findProfil->execute();
        return $findProfil->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Method qui renvoi true si il y a des occurences
     * @return bool
     */
    public function verifyPaypal() {
        $verif = 'SELECT `id_ya_users` FROM `ya_paypal` WHERE `id_ya_users`= :id;';
        $req = $this->db->prepare($verif);
        $req->bindValue(':id', $this->id, PDO::PARAM_INT);
        $req->execute();
        return $req->rowCount();
    }


    /**
     * Method qui retourne un TOKEN csrf
     * @return HASH
     */
    public function generateCSRFToken(){
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ%=%%%%%%%%%%%%%%%%%%%';
        $character = strlen($characters);
        $strng = '';
        for($i = 0; $i<$length; $i++){
            $strng .= $characters[mt_rand(0, $character -1)];
        }
        return $strng;
    }
    /**
     * method qui permet  d'enregistrer un token(jeton) de connexion
     * @return bool
     */
    public function updateToken() {
        $query = 'UPDATE `ya_users` SET `tokenUser`=:tokenUser WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $findProfil->bindValue(':tokenUser', $this->tokenUser, PDO::PARAM_STR);
        return $findProfil->execute();
    }

    public function getTokenUser() {
        $req = 'SELECT `tokenUser` FROM `ya_users` WHERE id=:id ';
        $prep = $this->db->prepare($req);
        $prep->bindValue(':id', $this->id, PDO::PARAM_INT);
        $prep->execute();
        $tokenId = $prep->fetch(PDO::FETCH_OBJ);
        return $tokenId->tokenUser;
    }

    /**
     * Method qui sert a inserer un nouveau user
     * @return requete INSERT
     */
    public function addUser() {
        $insert = 'INSERT INTO `ya_users` (`lastname`, `firstname`, `mail`, `pass`, `id_ya_role`) VALUES (:lastname, :firstname, :mail, :pass, :id_ya_role);';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $insertDb->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $insertDb->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $insertDb->bindValue(':pass', $this->pass, PDO::PARAM_STR);
        $insertDb->bindValue(':id_ya_role', $this->id_ya_role, PDO::PARAM_INT);
        return $insertDb->execute();
    }

    /**
     * Méthode qui vérifie si une adresse mail est libre.
     * 0 : L'adresse mail n'existe pas
     * 1 : Elle existe
     * @return type
     */
    function checkFreeMail() {
        $query = 'SELECT COUNT(*) AS `nbMail` FROM `ya_users` WHERE `mail` = :mail;';
        $result = $this->db->prepare($query);
        $result->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $result->execute();
        $checkFreeMail = $result->fetch(PDO::FETCH_OBJ);
        return $checkFreeMail->nbMail;
    }

    /**
     * Method qui renvoi true si il y a des occurences sur ma colonne mail de ma table users
     * @return bool
     */
    public function verifyMail() {
        $verif = 'SELECT `mail` FROM `ya_users` WHERE `mail`= :mail;';
        $reqmail = $this->db->prepare($verif);
        $reqmail->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $reqmail->execute();
        return $reqmail->rowCount();
    }

    /**
     * Method qui renvoi le contenue total d'un user si le mail et le mot de pass entrer corresponde
     * @return type bool fetch
     */
    public function connexion() {
        $co = 'SELECT * FROM `ya_users` WHERE `mail` = :mail AND `pass` = :pass;';
        $req = $this->db->prepare($co);
        $req->bindValue(':mail', $this->mailconnect, PDO::PARAM_STR);
        $req->bindValue(':pass', $this->passconnect, PDO::PARAM_STR);
        $req->execute();
        if ($req->rowCount() == 1) {
            $query = 'SELECT * FROM `ya_users` WHERE id';
            $queryResult = $this->db->query($query);
            $profil = $req->fetch(PDO::FETCH_OBJ);
            if (is_object($profil)) {
                $this->lastname = $profil->lastname;
                $this->firstname = $profil->firstname;
                $this->birthdate = $profil->birthdate;
                $this->mail = $profil->mail;
            }
            return $profil;
        } else {
            return $req->rowCount();
        }
    }

    /**
     * Method qui retourne les informations d'un user via son id passer en GET
     * @return boolean
     */
    public function getUserId() {
        $query = 'SELECT `id`, `lastname`, `firstname`, `mail`, `pass`, `id_ya_role` FROM `ya_users` WHERE `id`= :id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $findProfil->execute();
        return $findProfil->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Method qui retourne la liste des users
     * @return boolean
     */
    public function getAllUsers() {
        $query = 'SELECT `id`, `lastname`, `firstname`, `mail`, `pass`, `id_ya_role` FROM `ya_users` WHERE `id` NOT IN (1);';
        $findProfil = $this->db->query($query);
        return $findProfil->fetchAll(PDO::FETCH_OBJ);
    }

    public function modifyRole() {
        $query = 'UPDATE `ya_users` SET `id_ya_role`=:id_ya_role WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id_ya_role', $this->id_ya_role, PDO::PARAM_INT);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $findProfil->execute();
        echo '<meta http-equiv="refresh" content=";url=http://lacapsulememorial.fr/index.php?admin=' . $_SESSION['id'] .'" />';
    }

    /**
     * Method qui permet d'effacer un user
     * @return type DELETE
     */
    public function deleteUser() {
        $query = 'DELETE FROM `ya_users` WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }

    /**
     * Method qui permet de recuperer les infos d'un user via son mail
     * @return type SELECT
     */
    public function getUserMail() {
        $query = 'SELECT * FROM `ya_users` WHERE `mail`=:mail;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':mail', $this->mailconnect, PDO::PARAM_STR);
        if ($findProfil->execute()) {
            return $findProfil->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     *
     * @return le nombre d'utilisateur inscrit en base de donné
     */
    public function countUsers() {
        $query = 'SELECT COUNT(*) AS `nbUsers` FROM `ya_users`;';
        $count = $this->db->query($query);
        return $count->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Method qui permet à l'utilisateur de modifier son mot de passe via son id
     * @return bool
     */
    public function updatePassId() {
        $query = 'UPDATE `ya_users` SET `pass`=:pass WHERE `id`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':pass', $this->pass, PDO::PARAM_STR);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }

    /**
     * Method qui permet à l'utilisateur de modifier son mot de passe via son mail
     * @return bool
     */
    public function updatePassMail() {
        $query = 'UPDATE `ya_users` SET `pass`=:pass WHERE `mail`=:mail';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':pass', $this->pass, PDO::PARAM_STR);
        $findProfil->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $findProfil->execute();
    }

    /**
     * Method qui permet à un utilisateur de modifier un mail
     * @return bool
     */
    public function updateMailId() {
        $query = 'UPDATE `ya_users` SET `mail`=:mail WHERE `id`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }
}
?>
