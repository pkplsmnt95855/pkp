<?php

class SignupController extends Controller {

    public $layout = '//layouts/column2';

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    public function actionEmployer()
    {
        $model = new EmployerRegistrationForm();
        if (isset($_POST['EmployerRegistrationForm']))
        {
            $model->attributes = $_POST['EmployerRegistrationForm'];
            $model->logo = CUploadedFile::getInstance($model, 'logo');

            if ($model->validate())
            {
                $employer = new Employer();
                $employer->attributes = $model->attributes;
                $employer->status = 'Inactive';
                $employer->role = 'Employer';
                $employer->password = CPasswordHelper::hashPassword($employer->password);
                $employer->save();


                $uploadedFile = CUploadedFile::getInstance($model, 'logo');

                if (!empty($uploadedFile))
                {
                    $uploadedFileName = rand(0, 99) . "-" . $uploadedFile->name;
                    $filePath = Yii::app()->basePath . '/../upload/employer/' . $uploadedFileName;
                    $uploadedFile->saveAs($filePath);
                    $employer->logo = $uploadedFileName;
                }

                $employer->activation_key = Yii::app()->getSecurityManager()->generateRandomString(75, false) . $employer->id;
                if ($employer->save())
                {
                    $activation_url = Yii::app()->request->getBaseUrl(true) . '/employer/activate?key=' . $employer->activation_key;
                    $body = "Thank you for registering with Pakistan Placement. Your account is currently inactive. Please click the link below to activate your account.<br/><a href='" . $activation_url . "'>Click here to activate your account</a>";
                    $message = "Thank you for registering with Pakistan Placement. Your account is currently inactive. Please check your inbox to activate your account. If you do not see the email in inbox be sure to check spam/junk folder";
                    Yii::app()->user->setFlash('signupSuccess', $message);

                    if (Yii::app()->commons->sendPlainEmail($employer->email, "Activate Your Account", $body))
                        $this->redirect('success');
                }
            }
        }
        $this->render('employer_signup', array('model' => $model));
    }

    public function actionCandidate()
    {
        $model = new CandidateRegistrationForm();

        if (isset($_POST['CandidateRegistrationForm']))
        {
            $model->attributes = $_POST['CandidateRegistrationForm'];
            if ($model->validate())
            {
                $candidate = new Candidate();
                $candidate->attributes = $model->attributes;
                $candidate->status = 'Inactive';
                $candidate->role = 'Candidate';
                $candidate->password = CPasswordHelper::hashPassword($candidate->password);
                $candidate->save();


                $candidate->activation_key = Yii::app()->getSecurityManager()->generateRandomString(75, false) . $candidate->id;
                if ($candidate->save())
                {
                    $activation_url = Yii::app()->request->getBaseUrl(true) . '/candidate/activate?key=' . $candidate->activation_key;
                    $body = "Thank you for registering with Pakistan Placement. Your account is currently inactive. Please click the link below to activate your account.<br/><a href='" . $activation_url . "'>Click here to activate your account</a>";
                    $message = "Thank you for registering with Pakistan Placement. Your account is currently inactive. Please check your inbox to activate your account. If you do not see the email in inbox be sure to check spam/junk folder";
                    Yii::app()->user->setFlash('signupSuccess', $message);

                    if (Yii::app()->commons->sendPlainEmail($candidate->email, "Activate Your Account", $body))
                        $this->redirect('success');
                }
            }
        }
        $this->render('candidate_signup', array('model' => $model));
    }

    public function actionSuccess()
    {
        $this->render('signup_success');
    }

}
