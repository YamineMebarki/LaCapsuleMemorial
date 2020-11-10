<div class="container-fuid">
    <div class="page-header">
        <h1 class="fontStyle">Contacter le créateur du site</h1>
    </div>
    <form method="POST" action="">
        <?php if (isset($_POST['action']) && $_POST['action'] == 'envoyer' && empty($formError)) { ?>
            <div class="alert alert-success"><a class="close" data-dismiss="alert" href="#">&times;</a><?= isset($formSuccess['success']) ? $formSuccess['success'] : '' ?></div>
        <?php } else if ($formError) { ?>
            <div class="alert alert-error alert-danger"><a class="close text-danger" data-dismiss="alert" href="#">&times;</a><p><?= isset($formError['to']) ? $formError['to'] : '' ?></p>
                <p><?= isset($formError['message']) ? $formError['message'] : '' ?></p>
                <p><?= isset($formError['subject']) ? $formError['subject'] : '' ?></p>
                <p><?= isset($formError['error']) ? $formError['error'] : '' ?></p>
            </div>              
        <?php } else { ?>

        <?php } ?>
        <div class="control-group">
            <label for="to">Email</label>
            <div class="controls">
                <input type="text" name="to" id="to" class="span12 shadow" value="<?= isset($_POST['to']) ? $_POST['to'] : '' ?>"/>
            </div>
        </div>
        <div class="control-group">
            <label for="subject">pseudo</label>
            <div class="controls">
                <input type="text" name="subject" id="subject" class="span12 shadow" value="<?= isset($_POST['subject']) ? $_POST['subject'] : '' ?>" />
            </div>
        </div>
        <div class="control-group">
            <label for="message">Message</label>
            <div class="controls">
                <textarea name="message" id="message" class="span12 shadow" rows="10" cols="60"><?= isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
            </div>
        </div>
        <!--captcha d-inscription-->
        <div class="capt">
            <div>
                <label for="captcha"><h2 type="text" id="mainCaptcha"></h2></label>
                <p><input type="button" class="btn btn-warning" id="refresh" onclick="Captcha();" value="Générer captcha"/></p>
            </div>
            <div class="form-group"><label for="contactInput"><input class="form-control shadow" type="text" placeholder="Veuillez générer un captcha" id="contactInput" /></label></div>  
            <input id="Button3" type="button" class="btn btn-success" value="Valider ma réponse"/>
        </div>
        <div class="form-actions">
            <hr/>
            <div class="confirmCaptcha"></div>
        </div>
    </form>
</div>