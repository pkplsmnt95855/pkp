

<h1>Reset Your Password</h1>

<p>Please enter the email with which you have registered:</p>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'reset-password-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'confirmPassword'); ?>
        <?php echo $form->passwordField($model, 'confirmPassword'); ?>
        <?php echo $form->error($model, 'confirmPassword'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Reset Password'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
