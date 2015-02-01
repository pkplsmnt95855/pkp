<?php 

if(Yii::app()->user->hasFlash('signupSuccess')){?>

<p><?php echo Yii::app()->user->getFlash('signupSuccess');?></p>

<?php } ?>


