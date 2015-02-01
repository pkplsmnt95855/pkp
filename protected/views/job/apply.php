<h1>Apply</h1>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'job-application-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'cover_letter'); ?>
        <?php echo $form->textArea($model, 'cover_letter'); ?>
        <?php echo $form->error($model, 'cover_letter'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'resume_id'); ?>
        <?php echo $form->radioButtonList($model, 'resume_id', CHtml::listData($candidate_resumes, 'id', 'filename')); ?>
        <?php echo $form->error($model, 'resume_id'); ?>
    </div>





    <div class="row buttons">
        <?php echo CHtml::submitButton('Apply'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->