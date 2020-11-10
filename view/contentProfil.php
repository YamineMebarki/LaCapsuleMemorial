<!--content-->
<div class="container shadow rounded content1 center">
    <div class="row">
        <div class="col-12">
            <div id="biography">
                <h2 class="fontStyle"><b>Récit / Hommage :</b></h2>
                <?php if (isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']): ?>
                    <a data-toggle="modal" data-target="#content"><button type="button" class="btn btn-success">Éditer <i class="fas fa-edit"></i></button></a>
                    <?php
                else:
                    // Affichage du rendu visiteur
                    include 'biography.php';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id']): ?>
    <hr/>
    <h1 class="fontStyle center"><b>Rendu</b></h1>
    <div class="container shadow rounded">
        <div class="row">
            <div class="col-12">
                <hr/>
                <div class="view white shadow rounded"><?= html_entity_decode($flashInfo->biography) ?></div>
                <hr/>
            </div>
        </div>
    </div>
    <hr/>
    <div class="center">
        <?php if($success->success == true): ?>
        <?php else: ?>
            <div class=" text-center font">
                <img src="https://chart.googleapis.com/chart?cht=qr&chl=https://www.lacapsulememorial.fr/index.php?id=<?= $_SESSION['id'] ?>&chs=350" alt="QrPet" class="bord img" />
                <!-- <a data-toggle="modal" data-target="#paypal"><button class="btn btn-lg btn-success"><h3>Commander !</h3></a></button> -->
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<div class=" text-center font mt-5">
    <a data-toggle="modal" data-target="#album"><button class="btn btn-lg"><h3>Album Médias</h3><i class="far fa-images"></i></a></button>
</div>
<div class="center mt-4">
    <?php if(isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']): ?>
        <p class="font">Partager le mémorial sur Facebook</p>
        <div class="center mb-4" data-toggle='tooltip' data-placement='bottom' title="Patager votre mémorial sur Facebook" data-href="https://www.lacapsulememorial.fr/index.php?id=<?= $_SESSION['id'] ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.lacapsulememorial.fr%2Findex.php%3Fid=<?= $_SESSION['id'] ?>amp;src=sdkpreparse" class="fb-share-button btn btn-primary"><i class="fas fa-share-alt"></i> <i class="fab fa-facebook-square"></i></a>
        </div>
    <?php endif; ?>
    <div class="mt-5">
        <a data-toggle="modal" data-target="#comments"><button class="btn btn-warning fontStyle center gold"><i class="fas fa-book-open gold"></i> Livre d'Or <i class="fas fa-book-open gold"></i></button><a/>
            <form method="POST" action="#" class="mt-4">
                <a data-toggle="modal" data-target="#comment"><button type="button" class="btn bookGold font mb-5">Laissez un message sur le livre d'Or</button></a>
            </form>
    </div>
</div>
</div>
<!--modal laisser un commentaires-->
<div id="comment" class="modal center" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content content shadow">
            <div class="modal-header">
                <h3 class="font gold">Laissez un message sur le livre d'Or</h3>
                <button type="button" class="close text-danger" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <div class="golden">
                    <div class="container shadow">
                        <div class="row">
                            <div class="col-12 form-group">
                                <form method="POST" action="#">
                                    <label for="username" class="font">pseudo</label>
                                    <input type="text" name="username" class="form-control shadow" id="username"/>
                                    <label for="comment" class="font">Message:</label>
                                    <textarea type="text" name="comment" class="form-control shadow" rows="5" id="comment"><?= $comment->comments ?></textarea>
                                    <hr/>
                                    <div class="center">
                                        <!--captcha commentaires-->
                                        <div class="capt">
                                            <h2 type="text" id="mainCaptcha"></h2>
                                            <p type="text" id="com" class="text-success"></p>
                                            <p><input type="button" class="btn btn-warning" id="refresh" onclick="Captcha();" value="Générer captcha"/></p>
                                            <div class="form-group"><input class="form-control shadow" type="text" placeholder="Veuillez générer un captcha" id="commentInput" required /></div>
                                            <input id="Button2" type="button" class="btn btn-success" value="Valider ma réponse"/>
                                        </div>
                                        <hr/>
                                        <div class="confirmCaptcha"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal vue commentaires-->
<div id="comments" class="modal center" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h2 class="fontStyle center gold"><i class="fas fa-book-open gold"></i> Livre d'Or <i class="fas fa-book-open gold"></i></h2>
                <button type="button" class="close text-danger" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container shadow">
                        <div class="row">
                            <div class="col-12 form-group">
                                <div class="contentDream">
                                    <div class="container shadow rounded">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                foreach ($com as $comment):
                                                    if (isset($comment) && $comment->id_ya_commentstate == 2):
                                                        ?>
                                                        <div class="shadow white rounded mb-4">
                                                            <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']):
                                                                //Permet au propriétaire du profil de supprimer un commentaire
                                                                ?>
                                                                <form method="post">
                                                                    <button type="submit" class="close text-danger" data-toggle='tooltip' data-placement='top' title="Supprimer le message" name="deleteComment"> &times; </button>
                                                                    <input type="hidden" name="commentId" value="<?= $comment->id ?>" />
                                                                </form>
                                                            <?php endif; ?>
                                                            <span class="style">Message : </span>
                                                            <div class="view text-center"> <?= html_entity_decode($comment->comments); ?></div>
                                                            <div class="text-center style">Expéditeur : <?= $comment->username ?>, le <?= $comment->date ?> à <?= $comment->hour ?></div>
                                                        </div>
                                                    <?php else: ?>
                                                        <h3>Aucun commentaires</h3>
                                                    <?php endif;
                                                endforeach; ?>
                                                <?php if (empty($_SESSION['id'])): ?>
                                                    <div class="center alert-danger">
                                                        <h3 class="text-danger"><?= isset($formError['pseudo']) ? $formError['pseudo'] : '' ?></h3>
                                                        <h3 class="text-danger"><?= isset($formError['comment']) ? $formError['comment'] : '' ?></h3>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Modal album photo-->
<div id="album" class="modal center" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h3 class="font">Album photo</h3>
                <button type="button" class="close text-danger" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container shadow">
                        <div class="row">
                            <div class="col-12 form-group">
                                <?php
                                $nb_fichier = 0;
                                $directory = 'album_photo' . $_GET['id'];
                                if ($dossier = opendir('album_photo' . $_GET['id'])) :
                                    while (false != ($fichier = readdir($dossier))) :
                                        $extensionUpload = strtolower(substr(strrchr($fichier, '.'), 1));
                                        if ($fichier != '.' && $fichier != '..' && $fichier != 'index.php') :
                                            $nb_fichier++;
                                            if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']):?>
                                                <li><form action="" method="POST">
                                                        <button type="submit" class="close text-danger" data-toggle='tooltip' data-placement='top' title="Supprimer l'image" name="deletePicture"> &times; </button>
                                                        <input type="hidden" name="picture" value="<?= $fichier ?>" />
                                                    </form><?= $fichier ?></li>
                                            <?php endif;
                                            if( $extensionUpload == 'mp4'): ?>
                                                <hr/>
                                                <h4 class="font">Video</h4>
                                                <video class="img shadow" controls="controls">
                                                    <source src="<?= $directory . '/' . $fichier ?>" type="video/mp4" />
                                                </video>
                                                <?php
                                            else: ?>
                                                <a href="<?= $directory . '/' . $fichier ?>"><img class="img shadow" src="<?= $directory . '/' . $fichier ?>" /></a>
                                                <?php
                                            endif;
                                        endif;
                                    endwhile;
                                    if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']):
                                        ?>
                                        <p>Il y a <strong><?= $nb_fichier ?></strong> image(s) dans votre album.</p>
                                        <?php
                                    endif;
                                    closedir($dossier);
                                else :?>
                                    <p class="text-danger">erreur de chargement aucun album existant</p>
                                <?php endif; ?>
                                <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id']):
                                    if($nb_fichier == 5 ):?>
                                    <?php else: ?>
                                        <!--formulaire qui permet de modifier mon avatar grace à l'attribut enctype qui me permet l'utilisation correct du type file sur un input-->
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div><p class="font">Télécharger jusqu'à 5 images/videos confondus maximum.</p><label for="validphoto" class="font">Veuillez selectionner une image</label></div>
                                            <!--input de telecharger un fichier depuis une source local-->
                                            <label for="file1" class="label-file"><i class="fas fa-download btn btn-info"></i></label>
                                            <input type="file" name="picture" id="file1" class="input-file" />
                                            <!--button qui permet l'execution de la condition cibler par son name -->
                                            <button type="submit" name="validphoto" class="btn btn-sm btn-success" >Valider</button>
                                        </form>
                                        <?php
                                        if(isset($_POST['validphoto'])):?>
                                            <p class="anim moov text-success">Veuillez patienter pendant le telechargement...</p>
                                            <?php
                                        endif;
                                    endif;
                                endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal content-->
<div id="content" class="modal center" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h3 class="font">Édité votre mémorial</h3>
                <button type="button" class="close text-danger" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container shadow">
                        <div class="row">
                            <div class="col-12 form-group">
                                <form method="POST" action="">
                                    <textarea type="text" name="biography" class="ckeditor" id="mytextarea" ><?= $flashInfo->biography ?></textarea>
                                    <hr/>
                                    <button type="submit" name="update" class="btn btn-primary" >Enregistrer</button>
                                    <button type="submit" name="deleteContent" class="btn btn-danger" >Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--modal paypal-->
<div id="paypal" class="modal center" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content shadow">
            <div class="modal-header">
                <h3 class="font">Adresse de livraison</h3>
                <button type="button" class="close text-danger" data-dismiss="modal"> &times; </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    <div class="container shadow">
                        <div class="row">
                            <div class="col-12 form-group">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label for="adresse" class="font" >Adresse de livraison :</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" value="" placeholder="Adresse de livraison">
                                        <p><?= isset($formError['adresse']) ? $formError['adresse'] : '' ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="postalCode" class="font" >Code postal :</label>
                                        <input type="text" class="form-control" id="postalCode" name="postalCode" value="" placeholder="Code postal">
                                        <p><?= isset($formError['postalCode']) ? $formError['postalCode'] : '' ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="city"  class="font">Ville :</label>
                                        <input type="text" class="form-control" id="city" name="city" value="" placeholder="Ville">
                                        <p><?= isset($formError['city']) ? $formError['city'] : '' ?></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="id_ya_users" name="id_ya_users" value="<?= $_SESSION['id'] ?>">
                                    </div>
                                    <button type="button" name="ajax" id="ajax" class="btn btn-sucess" value="ajax">passer au paiement</button>
                                    <hr/>
                                    <div id="paypal-ajax"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>