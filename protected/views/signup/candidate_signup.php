<h1>Candidate Sign Up</h1>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'employer-signup-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'firstname'); ?>
        <?php echo $form->textField($model, 'firstname'); ?>
        <?php echo $form->error($model, 'firstname'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'lastname'); ?>
        <?php echo $form->textField($model, 'lastname'); ?>
        <?php echo $form->error($model, 'lastname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

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

    <div class="row">
        <?php echo $form->textField($model, 'verifyCode'); ?>
        <?php $this->widget('CCaptcha'); ?>
        <?php echo $form->error($model, 'verifyCode'); ?>
    </div>



    <div class="row buttons">
        <?php echo CHtml::submitButton('Register'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->