<div class="container-fuid content2 text-center mt-5">
    <div class="row">
        <div class="col-12">
            <div class="container-fuid">
                <div class="page-header">
                    <h1 class="title-font mt-5">Contacter le créateur du site</h1>
                </div>
                <div class="mt-5 mb-5">
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
                            <label for="to">Mail</label>
                            <div class="controls">
                                <input type="text" name="to" id="to" class="span12 shadow" value="<?= isset($_POST['to']) ? $_POST['to'] : '' ?>"/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="subject">Nom</label>
                            <div class="controls">
                                <input type="text" name="subject" id="subject" class="span12 shadow" value="<?= isset($_POST['subject']) ? $_POST['subject'] : '' ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label for="message">Message</label>
                            <div class="controls">
                                <textarea name="message" id="message" class="span12 shadow" rows="10" cols="20"><?= isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
                            </div>
                        </div>
                        <!--captcha d-inscription-->
                        <div class="capt">
                            <div>
                                <label for="captcha"><h2 type="text" id="mainCaptcha"></h2></label>
                                <p type="text" id="msg" class="text-success"></p>
                                <p><button type="button" class="btn" id="refresh" onclick="Captcha();" value=""><img src="assets/img/captcha.png" class="logo" /></button></p>
                            </div>
                            <div class="form-group"><label for="contactInput"><input class="form-control shadow" type="text" placeholder="Veuillez recopier le captcha" id="contactInput" /></label></div>
                            <button id="Button3" type="button" class="btn btn-success mb-5" value=""><b>Valider ma réponse</b></button>
                        </div>
                        <div class="form-actions">
                            <div class="confirmCaptcha"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>