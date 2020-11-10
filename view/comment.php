<?php if ($isOk): ?>
    <div class="container-fuid content mt-5">
        <div class="row">   
            <div class="col-12 mt-5">
                <h1 class="center font mt-5">Gestions des commentaires du profil</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 offset-xl-1 col-lg-8 offset-lg-2 col-md-10 offset-md-1 col-sm-12 col-xs-12">
                            <table class="table-responsive text-center mb-5 mt-5">
                                <thead>
                                    <tr>
                                        <th class="table">ID</th>
                                        <th class="table">PSEUDO</th>
                                        <th class="table">COMMENTAIRES</th>
                                        <th class="table">DATE</th>
                                        <th class="table">HOUR</th>
                                        <th class="table">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody class="table">
                                    <?php foreach ($com as $coms): ?> 
                                        <tr>
                                            <td data-label="PRENOM"><?= $coms->id ?></td>
                                            <td data-label="PRENOM"><?= $coms->username ?></td>
                                            <td data-label="COMMENT"><?= $coms->comments ?></td>
                                            <td data-label="DATE"><?= $coms->date ?></td>
                                            <td data-label="HOUR"><?= $coms->hour ?></td>
                                            <td data-label="STATUS">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="idComment" value="<?= $coms->id ?>">
                                                    <select name="id_ya_commentstate">
                                                        <?php foreach ($idState as $key => $state): ?>
                                                            <option value="<?= $key ?>" <?= isset($coms->id) && ($coms->id_ya_commentstate == $key) ? 'selected' : '' ?>><?= $state ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                            </td>
                                            <td>
                                                <button type="submit" name="changeState" class="btn btn-success">Confirmer</button>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="idComment" value="<?= $coms->id ?>">
                                                    <button type="submit" name="delete_comment" class="btn btn-danger">supprimer commentaire</button>    
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="content1 mt-5">
        <hr class="mt-5"/>
        <hr class="mt-5"/>
        <h1 class="text-center text-danger fontStyle mt-5">Aucuns commentaires</h1>
        <hr class="mt-5"/>
        <hr class="mt-5 "/>
    </div>
<?php endif; ?>



