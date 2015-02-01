<h1>Employer Sign Up</h1>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'employer-signup-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'company_name'); ?>
        <?php echo $form->textField($model, 'company_name'); ?>
        <?php echo $form->error($model, 'company_name'); ?>
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
        <?php echo $form->labelEx($model, 'logo'); ?>
        <?php echo $form->fileField($model, 'logo'); ?>
        <?php echo $form->error($model, 'logo'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'company_description'); ?>
        <?php echo $form->textArea($model, 'company_description'); ?>
        <?php echo $form->error($model, 'company_description'); ?>
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