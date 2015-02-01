<h1>All Jobs</h1>


<div class="form">
    <?php
    foreach ($jobs as $job)
    {
        ?>
        <div>
            <span>
                <span><a href="#"><?php echo $job['title']; ?></a></span>
                <span><a href="<?php echo Yii::app()->request->baseUrl;?>/employer/updatejob/<?php echo $job['id'];?>">Edit</a></span>
                <span><a href="<?php echo Yii::app()->request->baseUrl;?>/job/applicants/id/<?php echo $job['id'];?>">View Applicants</a></span>
            </span>
        </div>
    <?php } ?>
</div>

