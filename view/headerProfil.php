<div class="profil content1 center mt-5">
    <div class="container-fluid">
        <!--J'utilise bootstrap afin de créer une ligne -->
        <div class="row">
            <!--Puis j'utilise les 12 colonnes de la grille bootstrap afin d'occuper l'espace souhaiter lors de l'affichage-->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <?php if (isset($_SESSION[id]) && $_SESSION['id'] == $_GET['id']): ?>
                    <hr/>
                    <p class="font mt-5">Render public ou privé ce mémorial</p>
                    <form action="" method="POST">
                        <input type="hidden" name="idUser" value="<?= $flashInfo->id ?>">
                        <select name="id_ya_state">
                            <?php foreach ($stateView as $key => $state): ?>
                                <option value="<?= $key ?>" <?= isset($flashInfo->state) && ($flashInfo->state == $key) ? 'selected' : '' ?>><?= $state ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div>
                            <button type="submit" name="changeStateView" class="btn btn-success btn-sm">Confirmer</button>
                        </div>
                    </form>
                <?php endif; ?>
                <h1 class="fontStyle top">Bienvenue sur le mémorial de </h1>
                <h2 class="fontStyle mb-5"><?= $flashInfo->firstname. ' ' . $flashInfo->lastname // J'affiche le nom et le prenom de l'utilisateur     ?></h2>
                <img class="fb-image-sm imgProfil rounded " src="avatar/<?= $flashInfo->avatar // J'affiche l'avatar de l'utilisateur     ?>"   />
                <?php if (isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']): // Condition qui gére l'affichage d'un utilisateur connecter ?>
                    <!--formulaire qui permet de modifier mon avatar grace à l'attribut enctype qui me permet l'utilisation correct du type file sur un input-->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div><label for="validAvatar" class="font">Veuillez selectionner une image</label></div>
                        <!--input de telecharger un fichier depuis une source local-->
                        <label for="file" class="label-file"><i class="fas fa-download btn btn-info"></i></label>
                        <input type="file" name="photo" class="input-file" id="file" />
                        <!--button qui permet l'execution de la condition cibler par son name -->
                        <button type="submit" name="validAvatar" class="btn btn-sm btn-success" >Valider</button>
                    </form>
                    <?php if ($flashInfo->avatar != 'defaut.jpg'):  // Condition qui empêche de supprimer l'avatar de defaut ?>
                        <a data-toggle="modal" data-target="#deleteImg"><button class="btn btn-warning">Supprimer ma photo de profil</button></a>
                        <?php
                    endif;
                endif;
                ?>
                <p class="text-danger"><?= isset($formError['photo']) ? $formError['photo'] : '' ?></p>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']): ?>
        <!--modal supression avatar-->
        <div id="deleteImg" class="modal center" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="text-center font">Êtes vous sur de vouloir supprimer votre photo de profil ?</h3>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <input type="hidden" name="avatar" value="<?= $flashInfo->avatar ?>" />
                            <input type="submit" name="delete_avatar" class="btn btn btn-success" value="Confirmer" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--modal parametre-->
        <div id="parametreModal" class="modal center" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h2><i class="fas fa-sign-in-alt"><span class="font">Parametre du compte</span></i></h2>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>
                    <div class="modal-body">
                        <span class="font"><a href="index.php?comment=<?= $_SESSION['id'].'&userToken='. $tokenUser ?>" class="btn btn-default btn-lg gold">Gestion du livre d'Or</a></span>
                        <hr/>
                        <?php
                        //navbar profil admin
                        if (isset($_SESSION['id_ya_role']) && $_SESSION['id_ya_role'] == 35):
                            ?>
                            <span class="font marg"><a href="index.php?admin=<?= $_SESSION['id_ya_role'] ?>"><button class="btn btn-default btn-lg">Paramétres Admin</button></a></span>
                            <hr/>
                            <span class="font"><a href="index.php?moderator=<?= $_SESSION['id_ya_role'] ?>"><button class="btn btn-default btn-lg">Service Moderateur</button></a></span>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['id_ya_role']) && $_SESSION['id_ya_role'] == 2): ?>
                            <span class="font"><a href="index.php?moderator=<?= $_SESSION['id_ya_role'] ?>"><button class="btn btn-default btn-lg">Panneaux Moderator</button></a></span>
                        <?php endif; ?>
                        <hr/>
                        <a data-toggle="modal" data-target="#modifyPass"><button class="btn btn-warning">Modifier mon mot de passe</button></a>
                    </div>
                    <div class="modal-footer">
                        <a data-toggle="modal" data-target="#delete"><button class="btn btn-danger">Supprimer mon compte</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!--modal supression user-->
        <div id="delete" class="modal center" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h3 class="text-center font">Êtes vous sur de vouloir supprimer votre compte ?</h3>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-danger font">Une fois supprimer les données ne pourront êtres récupérées</h4>
                        <hr/>
                        <form action="" method="POST">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <input type="submit" name="delete_user" class="btn btn btn-success" value="Confirmer" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--modal modifier pass-->
        <div id="modifyPass" class="modal center" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h3 class="text-center font">Modifier mon mot de pass</h3>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="form-group font"><label for="oldPass">Veuillez entrer votre mot de pass actuel</label><input type="password" name="oldPass" id="oldPass" class="form-control shadow"/><div class="passMessage text-danger"></div></div>
                            <hr/>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <input type="hidden" id="userId" value="<?= $_SESSION['id'] ?>" />
                            <input type="submit"  value="Confirmer" name="prevalidPass" class="btn btn-success" id="prevalidPass" /></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--modal modifier mail-->
        <div id="modifyMail" class="modal center" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content shadow">
                    <div class="modal-header">
                        <h3 class="text-center font">Modifier mon adresse mail</h3>
                        <button type="button" class="close" data-dismiss="modal"> &times; </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            <div class="form-group font"><label for="oldMail">Veuillez entrer votre mail actuelle</label><input type="text" name="oldMail" id="oldMail" class="form-control shadow"/><div class=" mailMessage text-danger"></div></div>
                            <hr/>
                            <input type="hidden" name="commentId" value="<?= $comment->id ?>" />
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                            <input type="submit"  value="Confirmer" name="prevalidMail" class="btn btn-success" id="prevalidMail" /></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
