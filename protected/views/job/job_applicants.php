<h1>Applicants for this job</h1>


<div class="form">
    <?php
    foreach ($applicants as $applicant)
    {
        ?>
        <div>
            <span>
                <span><a href="#"><?php echo $applicant['candidate_id']; ?></a></span>
                <span><a href="<?php echo Yii::app()->request->baseUrl;?>/applicants/id/<?php echo $applicant['resume_id'];?>">View Resume</a></span>
            </span>
        </div>
    <?php } ?>
</div>

