<?php if ($isOk): ?>
    <hr/>
    <hr/>
    <hr/>
    <div class="container-fuid content mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="center font">Panneau de contrôle Administrateur</h1>
                <?php foreach ($nbUsers as $nb): ?>
                    <p class="text-center"> Il y a : <b><?= $nb->nbUsers; ?></b> utilisateurs enregisters;</p>
                <?php endforeach; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
                            <table class="table-responsive text-center mt-5 mb-5">
                                <thead>
                                <tr>
                                    <th class="table">ID</th>
                                    <th class="table">NOM</th>
                                    <th class="table">PRENOM</th>
                                    <th class="table">ADRESSE MAIL</th>
                                    <th class="table">ROLE</th>
                                    <th class="table"></th>
                                    <th class="table">PROFIL</th>
                                </tr>
                                </thead>
                                <tbody class="table">
                                <?php foreach ($all as $users): ?>
                                    <form action="" method="POST">
                                        <tr>
                                            <td data-label="ID"><?= $users->id ?></td>
                                            <td data-label="NOM"><?= $users->lastname ?></td>
                                            <td data-label="PRENOM"><?= $users->firstname ?></td>
                                            <td data-label="MAIL"><?= $users->mail ?></td>
                                            <td data-label="ROLE">
                                                <input type="hidden" name="idUser" value="<?= $users->id ?>">
                                                <select name="id_ya_role">
                                                    <?php foreach ($idRole as $key => $role): ?>
                                                        <option value="<?= $key ?>" <?= isset($users->id) && ($users->id_ya_role == $key) ? 'selected' : '' ?>><?= $role ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <input type="hidden" name="idUser" value="<?= $users->id ?>">
                                            </td>
                                            <td>
                                                <button type="submit"  id="modify" name="changeRole" class="btn btn-sm btn-danger">modifier</button>
                                            </td>
                                            <td data-label="PROFIL"><a href="index.php?id=<?= $users->id ?>"><span class="text-dark">voir</span></a></td>
                                            <td class="text-center">
                                                <input type="text" name="idUser" value="<?= $users->id; ?>">
                                                <button type="submit" name="delete_profil" class="btn btn-danger">supprimer profil</button>
                                                <!--<a data-toggle="modal" data-target="#deleteUser"><button class="btn btn-danger">Supprimer</button></a>-->
                                                <!--modal supression user-->
                                                <div id="deleteUser" class="modal center" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content shadow">
                                                            <div class="modal-header">
                                                                <h3 class="text-center font">Êtes vous sur de vouloir supprimer le compte ?</h3>
                                                                <button type="button" class="close" data-dismiss="modal"> &times; </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 class="text-danger font">Une fois supprimer les données ne pourront êtres récupérées</h4>
                                                                <hr/>
                                                                <input type="text" name="idUser" value="<?= $users->id; ?>">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                                                <button type="submit" name="delete_profil" class="btn btn-success">supprimer profil</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
else:
    include 'view/contentError.php';
endif;
?>
