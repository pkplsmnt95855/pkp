
<div style="float:left;">

    <h1>Sign-In</h1>

    <p>Securely sign in with your resume market account</p>
    <?php if (Yii::app()->user->hasFlash('success_flash')) { ?>
        <p class="alert alert-success"><?php echo Yii::app()->user->getFlash('success_flash'); ?></p>
    <?php } ?>
    <?php if (Yii::app()->user->hasFlash('error_flash')) { ?>
        <p class="alert alert-danger"><?php echo Yii::app()->user->getFlash('error_flash'); ?></p>
    <?php } ?>
    <div class="form">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
        ));
        ?>

        <div class="row">
            <?php echo $form->labelEx($login, 'email'); ?>
            <?php echo $form->textField($login, 'email'); ?>
            <?php echo $form->error($login, 'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($login, 'password'); ?>
            <?php echo $form->passwordField($login, 'password'); ?>
            <?php echo $form->error($login, 'password'); ?>
        </div>

        <div class="row buttons">
            <?php echo CHtml::submitButton('Login'); ?>
        </div>

        <?php $this->endWidget(); ?>
        
        <div>
            <a href="<?php echo $facebook_url;?>">Login With Facebook</a><br/><br/>
            <a href="<?php echo $google_url;?>">Login With Google</a><br/><br/>
            <a href="<?php echo $linkedin_url;?>">Login With LinkedIn</a><br/><br/>
        </div>
    </div>
</div>