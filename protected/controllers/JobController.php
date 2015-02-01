<?php

class JobController extends Controller {

    public $layout = '//layouts/column2';

    public function actionIndex($id)
    {
        $job = Job::model()->with('jobLocations')->with('jobSkills')->findByPk($id);
        $job_skills = $job->jobSkills;
        $job_locations = $job->jobLocations;

        $this->render('job_details', array('job' => $job, 'job_skills' => $job_skills, 'job_locations' => $job_locations));
    }

    public function actionApply($id)
    {
        $already_applied = JobApplication::model()->findByAttributes(array('job_id' => $id, 'candidate_id' => Yii::app()->user->id));
        if (!empty($already_applied))
        {
            Yii::app()->user->setFlash('error', 'You have already applied for this job');
            $this->redirect(array('job/appliedjobs/'));
        }

        $model = new JobApplication();
        if (isset($_POST['JobApplication']))
        {
            $model->attributes = $_POST['JobApplication'];
            $model->status = 'Applied';
            $model->candidate_id = Yii::app()->user->id;
            $model->date_applied = new CDbExpression('NOW()');
            $model->job_id = $id;

            if ($model->validate())
            {
                if ($model->save())
                    $this->redirect(array('candidate/appliedjobs/'));
            }
        }
        $candidate_resumes = CandidateResume::model()->findAllByAttributes(array('candidate_id' => Yii::app()->user->id));
        $this->render('apply', array('model' => $model, 'candidate_resumes' => $candidate_resumes));
    }

    
    
    public function actionApplicants($id)
    {
        $job_applicants=JobApplication::model()->findAllByAttributes(array('job_id'=>$id));
        $this->render('job_applicants',array('applicants'=>$job_applicants));
    }
    
    

}
