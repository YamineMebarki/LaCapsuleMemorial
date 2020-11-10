<?php

class flashContent extends database {

    public $qrCode = '';
    public $content = '';
    public $id = 0;
    public $photo = '';
    public $id_ya_users = 0;
    public $article = '';
    public $datehour = '0000/00/00 00:00:00';

/**
 * Method construct qui ce connecte a ma base de données
 */
    public function __construct() {
        parent::__construct();
    }
    public function insertAvatar() {
        $update = 'INSERT INTO `ya_flashcontent` (`avatar`, `id_ya_users`) VALUES(:photo, :id_ya_users)';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        $updateDb->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        return $updateDb->execute();
    }
    /**
     * Method qui permet d'inserer un qrcode en base
     * @return type bool
     */
    public function insertQr() {
        $update = 'INSERT INTO `ya_flashcontent` (`qrcode`, `id_ya_users`) VALUES(:qrCode, :id_ya_users)';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':qrCode', $this->qrCode, PDO::PARAM_STR);
        $updateDb->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        return $updateDb->execute();
    }
    /**
     * Method qui permet d'update un avatar en base de données
     * @return bool
     */
    public function updateAvatar() {
        $update = 'UPDATE `ya_flashcontent` SET `avatar`=:photo WHERE `id_ya_users`=:id';
        $updateDb = $this->db->prepare($update);
        $updateDb->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        $updateDb->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        return $updateDb->execute();
    }
    /**
     * Method qui retourne l'ensemble des informations d'un utilisateurs via son id
     * @return bool
     */
    public function getFlashContentId() {
        $query = 'SELECT `ya_flashcontent`.`biography`,  `ya_flashcontent`.`avatar`, `ya_flashcontent`.`state`, DATE_FORMAT(`ya_flashcontent`.`datehour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`ya_flashcontent`.`datehour`, "%H:%i") AS `hour`, `ya_flashcontent`.`qrcode`, `ya_flashcontent`.`id_ya_users`, `ya_users`.`lastname`, `ya_users`.`firstname`, `ya_users`.`mail`, `ya_users`.`pass`, `ya_users`.`id_ya_role`  FROM `ya_flashcontent` INNER JOIN `ya_users` ON `ya_flashcontent`.`id_ya_users` = `ya_users`.`id` WHERE `ya_flashcontent`.`id_ya_users`=:id_ya_users';
        //  $query = 'SELECT `biography`, `avatar`, `qrcode`, `id_ya_users` FROM `ya_flashcontent` WHERE `id_ya_users`= :id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        $findProfil->execute();
        return $profil = $findProfil->fetch(PDO::FETCH_OBJ);
    }
    /**
     * Method qui permet d'effacer un avatar
     * @return bool
     */
    public function deleteAvatar() {
        $query = 'UPDATE `ya_flashcontent` SET `avatar`=:photo WHERE `id_ya_users`=:id_ya_users';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        $findProfil->bindValue(':photo', $this->photo, PDO::PARAM_STR);
        return $findProfil->execute();
    }
     /**
     * Methode qui permet d'inserer un contenu de profil via ckeditor
     * @return type bool
     */
    public function insertContent() {
        $insert = 'INSERT INTO `ya_flashcontent` (`biography`, `id_ya_users`) VALUES(:content, :id)';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':id', $this->id, PDO::PARAM_INT);
        $insertDb->bindValue(':content', $this->content, PDO::PARAM_STR);
        return $insertDb->execute();
    }
    /**
     * Method qui permet de recuperer le contenu d'un profil via son id
     * @return bool
     */
    public function getContentId() {
        $profil = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `id`, `biography`, `avatar` FROM `ya_flashcontent` WHERE `id_ya_users`= :id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetch(PDO::FETCH_OBJ);
        }
        if (is_object($profil)) {
            $this->content = $profil->biography;
            $this->photo = $profil->avatar;
            $isOk = TRUE;
        }
        return $isOk;
    }
/**
 * Method qui permet de modifier le contenu de son profil
 * @return bool
 */
    public function updateContent() {
        $query = 'UPDATE `ya_flashcontent` SET `biography`=:content WHERE `id_ya_users`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':content', $this->content, PDO::PARAM_STR);
        $findProfil->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        return $findProfil->execute();
    }
    /**
     * Method qui permet de supprimer le contenu d'un profil
     * @return bool
     */
    public function deleteContent() {
        $query = 'UPDATE `ya_flashcontent` SET `biography`=:content WHERE `id_ya_users`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':content', $this->content, PDO::PARAM_STR);
        $findProfil->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        return $findProfil->execute();
    }
          /**
     * Method qui permet de modifier le status d'une vue d'un profil
     * @return bool
     */
    public function modifyStateView() {
        $query = 'UPDATE `ya_flashcontent` SET `state`=:state WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':state', $this->state, PDO::PARAM_INT);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }
}
?>


