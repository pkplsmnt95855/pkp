<?php

class CandidateController extends Controller {

    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        echo "here";
    }

    public function actionUploadResume()
    {
        $model = new ResumeUploadForm();
        if (isset($_POST['ResumeUploadForm']))
        {
            $model->attributes = $_POST['ResumeUploadForm'];
            if ($model->validate())
            {
                $uploadedFile = CUploadedFile::getInstance($model, 'cv');
                if (!empty($uploadedFile))
                {
                    $resumeDirectory = date('mY');

                    $folder = 'upload/candidate/' . $resumeDirectory . "/";
                    if (!file_exists($folder))
                    {
                        mkdir("upload/candidate/" . $resumeDirectory."/", 0777);
                    }
                    $uploadedFileName = rand(0, 99) . Yii::app()->user->id . "-" . $uploadedFile->name;

                    $filePath = $folder . $uploadedFileName;
                    $uploadedFile->saveAs($filePath);
                    $candidate_resume = new CandidateResume();
                    $candidate_resume->filename = $uploadedFileName;
                    $candidate_resume->directory_name = $resumeDirectory;
                    $candidate_resume->date_uploaded = new CDbExpression('NOW()');
                    $candidate_resume->candidate_id = Yii::app()->user->id;
                    if ($candidate_resume->save())
                        $this->redirect('myresumes');
                }
            }
            print_r($model->getErrors());
        }
        $this->render('upload_resume', array('model' => $model));
    }

    public function actionMyResumes()
    {
        $resumes = CandidateResume::model()->findAllByAttributes(array('candidate_id' => Yii::app()->user->id));
        CVarDumper::dump($resumes, 10, 1);
    }
    
    public function actionAppliedJobs()
    {
        $applied_jobs = JobApplication::model()->findAllByAttributes(array('candidate_id' => Yii::app()->user->id));
        CVarDumper::dump($applied_jobs, 10, 1);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
