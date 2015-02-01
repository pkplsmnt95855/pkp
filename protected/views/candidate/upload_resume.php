<h1>Upload Resume</h1>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'resume-upload-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'cv'); ?>
        <?php echo $form->fileField($model, 'cv'); ?>
        <?php echo $form->error($model, 'cv'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Upload'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->