<?php

class EmployerController extends Controller {

    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        $this->render('dashboard');
    }
    
    public function actionLogin()
    {
        $this->layout='main1';
        $model=new LoginForm();
        $model->userType='Employer';
        
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            
            if($model->validate())
            {
                $this->redirect(array('employer/'));
            }
        }
        
        $this->render('login',array('model'=>$model));
    }

    public function actionPostJob()
    {
        $career_levels = Yii::app()->postjob->getCareerLevels();
        $minimum_salaries = Yii::app()->postjob->getMinimumSalaries();
        $maximum_salaries = Yii::app()->postjob->getMaximumSalaries();
        $experience_levels = Yii::app()->postjob->getExperienceLevels();
        $genders = Yii::app()->postjob->getGenders();
        $departments = Yii::app()->postjob->getDepartments();
        $industries = Yii::app()->postjob->getIndustries();
        $job_types = Yii::app()->postjob->getJobTypes();
        $traveling = Yii::app()->postjob->getRequiredTraveling();
        $locations = Location::model()->findAll();
        $skills = Skill::model()->findAll();
        $model = new JobPostForm();

        if (isset($_POST['JobPostForm']))
        {
            $model->attributes = $_POST['JobPostForm'];
            if ($model->validate())
            {
                $job = new Job();
                $job->attributes = $model->attributes;
                $job->expiry_date = date('Y-m-d H:i:s', strtotime('+1439 minutes', strtotime($model->expiry_date)));
                $job->status = 'Active';
                $job->employer_id = Yii::app()->user->id;
                $job->posted_date = new CDbExpression('NOW()');
                if ($job->save())
                {
                    foreach ($_POST['location'] as $location)
                    {
                        $jobLocation = new JobLocation();
                        $jobLocation->location_id = intval($location['id']);
                        $jobLocation->job_id = $job->id;
                        $jobLocation->save();
                    }
                    if (!empty($_POST['skill']))
                    {
                        foreach ($_POST['skill'] as $skill)
                        {
                            $jobSkill = new JobSkill();
                            $jobSkill->job_id = $job->id;
                            $jobSkill->skill_id = intval($skill['id']);
                            $jobSkill->save();
                        }
                    }
                    $this->setFlash('success', 'Your job has been posted successfully');
                    $this->redirect('alljobs');
                }
            }
        }
        $this->render('post_job', array(
            'model' => $model,
            'career_levels' => $career_levels,
            'minimum_salaries' => $minimum_salaries,
            'maximum_salaries' => $maximum_salaries,
            'experience_levels' => $experience_levels,
            'genders' => $genders,
            'industries' => $industries,
            'traveling' => $traveling,
            'departments' => $departments,
            'job_types' => $job_types,
            'locations' => $locations,
            'skills' => $skills
        ));
    }

    public function actionAllJobs()
    {
        $jobs = Job::model()->findAllByAttributes(array('employer_id' => 1), array('order' => 'id desc'));
        $this->render('alljobs', array('jobs' => $jobs));
    }

    public function actionUpdateJob($id)
    {
        $model = Job::model()->findByPk($id);
        $career_levels = Yii::app()->postjob->getCareerLevels();
        $minimum_salaries = Yii::app()->postjob->getMinimumSalaries();
        $maximum_salaries = Yii::app()->postjob->getMaximumSalaries();
        $experience_levels = Yii::app()->postjob->getExperienceLevels();
        $genders = Yii::app()->postjob->getGenders();
        $departments = Yii::app()->postjob->getDepartments();
        $industries = Yii::app()->postjob->getIndustries();
        $job_types = Yii::app()->postjob->getJobTypes();
        $traveling = Yii::app()->postjob->getRequiredTraveling();
        $locations = Location::model()->findAll();
        $skills = Skill::model()->findAll();
        foreach ($model->jobLocations as $location)
        {
            $job_locations[] = $location['location_id'];
        }
        if (!empty($model->jobSkills))
        {
            foreach ($model->jobSkills as $value)
            {
                $job_skills[] = $value['skill_id'];
            }
        } else
        {
            $job_skills = null;
        }

        if (isset($_POST['Job']))
        {
            $model->attributes = $_POST['Job'];
            if ($model->validate())
            {
                $model->expiry_date = date('Y-m-d H:i:s', strtotime('+1439 minutes', strtotime($model->expiry_date)));
                if ($model->save())
                {
                    foreach ($model->jobLocations as $location)
                    {
                        $location->delete();
                    }
                    foreach ($_POST['location'] as $location)
                    {
                        $jobLocation = new JobLocation();
                        $jobLocation->location_id = intval($location['id']);
                        $jobLocation->job_id = $model->id;
                        $jobLocation->save();
                    }

                    if (!empty($model->jobSkills))
                    {
                        foreach ($model->jobSkills as $skill)
                        {
                            $skill->delete();
                        }
                    }

                    if (!empty($_POST['skill']))
                    {
                        foreach ($_POST['skill'] as $skill)
                        {
                            $jobSkill = new JobSkill();
                            $jobSkill->job_id = $model->id;
                            $jobSkill->skill_id = intval($skill['id']);
                            $jobSkill->save();
                        }
                    }
                }
            }
        }

        $this->render('update_job', array(
            'model' => $model,
            'career_levels' => $career_levels,
            'minimum_salaries' => $minimum_salaries,
            'maximum_salaries' => $maximum_salaries,
            'experience_levels' => $experience_levels,
            'genders' => $genders,
            'industries' => $industries,
            'traveling' => $traveling,
            'departments' => $departments,
            'job_types' => $job_types,
            'locations' => $locations,
            'skills' => $skills,
            'job_skills' => $job_skills,
            'job_locations' => $job_locations
        ));
    }
    
    
    

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
