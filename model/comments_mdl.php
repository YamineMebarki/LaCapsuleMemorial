<?php

class comments extends database {

    public $id = 0;
    public $username = '';
    public $comments = '';
    public $id_ya_commentstate = 0;
    public $datehour = '0000/00/00 00:00:00';
    public $id_ya_users = 0;
    public $id_ya_flashcontent = 0;
    public $id_ya_comments = 0;

    /**
     * Method qui permet la connexion a ma base de données via la class parent database apeler grace à la method magique
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Method qui permet d'inserer un commentaire
     * @return bool
     */
    public function insertComment() {
        $insert = 'INSERT INTO `ya_comments` ( `username`, `comments`, `id_ya_users`, `id_ya_flashcontent`, `id_ya_commentstate` ) VALUES (:username, :comment, :id_ya_users, :id_ya_flashcontent, 1)';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':username', $this->username, PDO::PARAM_STR);
        $insertDb->bindValue(':comment', $this->comments, PDO::PARAM_STR);
        $insertDb->bindValue(':id_ya_users', $this->id_ya_users, PDO::PARAM_INT);
        $insertDb->bindValue(':id_ya_flashcontent', $this->id_ya_flashcontent, PDO::PARAM_INT);
        return $insertDb->execute();
    }

    /**
     * Method qui retourne le contenu d'un commentaire
     * @return bool
     */
    public function getCommentId() {
        $profil = FALSE;
        $isOk = FALSE;
        $query = 'SELECT `id`, `username`, `comments`, DATE_FORMAT(`datehour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`datehour`, "%H:%i") AS `hour`, `id_ya_users`,`id_ya_flashcontent` FROM `ya_comments` WHERE `id_ya_users`= :id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        if ($findProfil->execute()) {
            $profil = $findProfil->fetchAll(PDO::FETCH_OBJ);
        }
        // Hydratation qui permet de récuperer les valeur souhaiter dans la requete et ainsi l'attribuer aux attribu de la class
        if (is_object($profil)) {
            $this->id = $profil->id;
            $this->comments = $profil->comments;
            $this->date = $profil->date;
            $this->hour = $profil->hour;
            $isOk = TRUE;
        }
        return $isOk;
    }

    /**
     * Method qui permet de recuperer les commentaires d'un utilisateur via son id
     * @return bool
     */
    public function getAllCommentsUser() {
        $profil = FALSE;
        $query = 'SELECT  `id`, `username`, `comments`, DATE_FORMAT(`datehour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`datehour`, "%H:%i") AS `hour`, `id_ya_users`, `id_ya_flashcontent`, `id_ya_commentstate` FROM `ya_comments` WHERE `id_ya_users`= :id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id_ya_users, PDO::PARAM_INT);
        $findProfil->execute();
        return $profil = $findProfil->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Method qui permet de recuperer tous les commentaires de la table ya_comments
     * @return bool
     */
    public function getAllComments() {
        $profil = FALSE;
        $query = 'SELECT  `id`, `username`, `comments`, DATE_FORMAT(`datehour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`datehour`, "%H:%i") AS `hour`, `id_ya_users`, `id_ya_flashcontent`, `id_ya_commentstate` FROM `ya_comments`;';
        $findProfil = $this->db->query($query);
        return $profil = $findProfil->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Method qui permet de recuperer le status d'un commentaire
     * @return bool
     */
    public function getStateComment() {
        $query = 'SELECT  `ya_comments`.`id`, `ya_comments`.`username`, `ya_comments`.`comments`, DATE_FORMAT(`ya_comments`.`datehour`, "%d/%m/%Y") AS `date`, DATE_FORMAT(`ya_comments`.`datehour`, "%H:%i") AS `hour`, `ya_comments`.`id_ya_users`, `ya_comments`.`id_ya_flashcontent`, `ya_comments`.`id_ya_commentstate`, `ya_commentstate`.`id`, `ya_commentstate`.`state` FROM `ya_comments` INNER JOIN `ya_commentstate` ON `ya_comments`.`id_ya_commentstate`=`ya_commentstate`.`id` WHERE `ya_comments`.`id`= :id_ya_comments';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id_ya_comments', $this->id_ya_comments, PDO::PARAM_INT);
        $findProfil->execute();
        return $profil = $findProfil->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Method qui permet de mettre à jour un commentaire
     * @return bool
     */
    public function updateCommentId() {
        $query = 'UPDATE `ya_article` SET `article`=:article WHERE `id_ya_users`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':article', $this->article, PDO::PARAM_STR);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }

    /**
     * Method qui permet de modifier le status d'un commentaire
     * @return bool
     */
    public function modifyCommentState() {
        $query = 'UPDATE `ya_comments` SET `id_ya_commentstate`=:id_ya_commentstate WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id_ya_commentstate', $this->id_ya_commentstate, PDO::PARAM_INT);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }

    /**
     * Method qui permet de supprimer un commentaire
     * @return bool
     */
    public function deleteCommentId() {
        $query = 'DELETE FROM `ya_comments` WHERE `id`=:id';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }

}
?>

