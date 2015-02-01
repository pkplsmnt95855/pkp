<h1>Post A Job</h1>


<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'post-job-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>


    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'degree_title'); ?>
        <?php echo $form->textField($model, 'degree_title'); ?>
        <?php echo $form->error($model, 'degree_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'career_level'); ?>
        <?php echo $form->dropDownList($model, 'career_level', $career_levels, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'career_level'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'minimum_salary'); ?>
        <?php echo $form->dropDownList($model, 'minimum_salary', $minimum_salaries, array('prompt' => 'Please select', 'id' => 'Employer_minSalary')); ?>
        <?php echo $form->error($model, 'minimum_salary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'maximum_salary'); ?>
        <?php echo $form->dropDownList($model, 'maximum_salary', $maximum_salaries, array('prompt' => 'Please select', 'id' => 'Employer_maxSalary')); ?>
        <?php echo $form->error($model, 'maximum_salary'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'minimum_experience'); ?>
        <?php echo $form->dropDownList($model, 'minimum_experience', $experience_levels, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'minimum_experience'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'required_travel'); ?>
        <?php echo $form->dropDownList($model, 'required_travel', $traveling, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'required_travel'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'age'); ?>
        <?php $model->age = 18; ?>
        <?php echo $form->numberField($model, 'age', array('min' => 18)); ?>
        <?php echo $form->error($model, 'age'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gender'); ?>
        <?php echo $form->dropDownList($model, 'gender', $genders, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'gender'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'department'); ?>
        <?php echo $form->dropDownList($model, 'department', $departments, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'department'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'industry'); ?>
        <?php echo $form->dropDownList($model, 'industry', $industries, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'industry'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::label('Job Locations', 'location'); ?>
        <?php
        $this->widget('Select2', array(
            'name' => 'location',
            'id' => 'location',
            'multiple' => true,
            'data' => CHtml::listData($locations, 'id', 'location')
        ));
        ?>
        <?php echo $form->error($model, 'locations'); ?>
    </div>



    <div class="row">
        <?php echo $form->labelEx($model, 'number_of_positions'); ?>
        <?php $model->number_of_positions = 1; ?>
        <?php echo $form->numberField($model, 'number_of_positions', array('min' => 1)); ?>
        <?php echo $form->error($model, 'number_of_positions'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'job_type'); ?>
        <?php echo $form->dropDownList($model, 'job_type', $job_types, array('prompt' => 'Please select')); ?>
        <?php echo $form->error($model, 'job_type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'expiry_date'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'attribute' => 'expiry_date',
            'model'=>$model
        ));
        ?>
        <?php echo $form->error($model, 'expiry_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'job_description'); ?>
        <?php echo $form->textArea($model, 'job_description'); ?>
        <?php echo $form->error($model, 'job_description'); ?>
    </div>

    <div class="row">
        <?php echo CHtml::label('Skills', 'skill'); ?>
        <?php
        $this->widget('Select2', array(
            'name' => 'skill',
            'value'=>array(1,2),
            'id' => 'skill',
            'multiple' => true,
            'data' => CHtml::listData($skills, 'id', 'skillname')
        ));
        ?>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Post'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->

<script>
    $("#Employer_minSalary").change(function () {
        var minSalary = $(this).val();
        var maxSalary = $("#Employer_maxSalary").val();

        $.ajax({
            type: 'post',
            url: '<?php echo Yii::app()->createAbsoluteUrl('ajax/getmaxsalaries'); ?>',
            data: 'minSalary=' + minSalary,
            success: function (response) {
                if (maxSalary < minSalary)
                {
                    $("#Employer_maxSalary").html(response);
                }
                else
                {
                    $("#Employer_maxSalary").html(response);
                    $("#Employer_maxSalary").val(maxSalary);
                }
            },
        });
    });

    $("#Employer_maxSalary").change(function () {

        var maxSalary = $(this).val();
        var minSalary = $("#Employer_minSalary").val();
        $.ajax({
            type: 'post',
            url: '<?php echo Yii::app()->createAbsoluteUrl('ajax/getminsalaries'); ?>',
            data: 'maxSalary=' + maxSalary,
            success: function (response) {

                if (maxSalary < minSalary)
                {
                    $("#Employer_minSalary").html(response);
                }
                else
                {
                    $("#Employer_minSalary").html(response);
                    $("#Employer_minSalary").val(minSalary);
                }
            },
            error: function () {

            },
        });
    });

</script>