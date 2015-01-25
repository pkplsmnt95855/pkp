

<h1>Resend Activation Email</h1>

<p>Please enter the email with which you have registered:</p>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'resendactivation-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Resend Activaiton Link'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->
