<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {

        echo "tests";
    }

    public function actionResendActivation()
    {
        $model = new ResendActivationForm();
        if (isset($_POST['ResendActivationForm']))
        {
            $model->attributes = $_POST['ResendActivationForm'];
            if ($model->validate())
            {
                $user = User::model()->findByAttributes(array('email' => $model->email));
                $user->activation_key = Yii::app()->getSecurityManager()->generateRandomString(75, false) . $user->id;
                if ($user->update())
                {
                    $activation_url = Yii::app()->request->getBaseUrl(true) . '/site/activate?key=' . $user->activation_key;
                    $body = "You are receiving this email because you have reequested account activation link.Please click the link below to activate your account.<br/><a href='" . $activation_url . "'>Click here to activate your account</a>";
                    if (Yii::app()->commons->sendPlainEmail($user->email, "Activate Your Account", $body))
                    {
                        Yii::app()->user->setFlash('success_flash', 'We have resent you activation email to activate your account');
                    }
                }
            }
        }

        $this->render('resend_activation', array('model' => $model));
    }

    public function actionForgotPassword()
    {
        $model = new ForgotPasswordForm();
        if (isset($_POST['ForgotPasswordForm']))
        {
            $model->attributes = $_POST['ForgotPasswordForm'];
            if ($model->validate())
            {
                $user = User::model()->findByAttributes(array('email' => $model->email));
                $user->reset_key = Yii::app()->getSecurityManager()->generateRandomString(75, false). $user->id;
                if ($user->update())
                {
                    $activation_url = Yii::app()->request->getBaseUrl(true) . '/site/resetpassword?key=' . $user->reset_key;
                    $body = ".Please click the link below to reset password for your account.<br/><a href='" . $activation_url . "'>Click here to reset password</a>";
                    if (Yii::app()->commons->sendPlainEmail($user->email, "Reset Password Request", $body))
                    {
                        Yii::app()->user->setFlash('success_flash', 'We have sent you an email with the instructions to reset your password.');
                    }
                }
            }
        }
        $this->render('forgot_password', array('model' => $model));
    }

    public function actionResetPassword()
    {
        $key = Yii::app()->getRequest()->getQuery('key', null);
        if ($key)
        {
            $user = User::model()->findByAttributes(array('reset_key' => $key));
            if (!empty($user))
            {
                $model = new ResetPasswordForm();
                if (isset($_POST['ResetPasswordForm']))
                {
                    $model->attributes = $_POST['ResetPasswordForm'];
                    if ($model->validate())
                    {
                        $user->password=  CPasswordHelper::hashPassword($model->password);
                        $user->reset_key=null;
                        if($user->update())
                        {
                            Yii::app()->user->setFlash('success_flash','Your password has been reset. You may login below now');
                            $this->redirect(array('login/'));
                        }
                    }
                }
                $this->render('reset_password', array('model' => $model));
            }
            else
            {
                Yii::app()->user->setFlash('error_flash','Invalid reset link. Please request new link');
                $this->redirect(array('login/'));
            }
        } else
        {
            $this->redirect(array('login/'));
        }
    }

    public function actionActivate()
    {
        $key = Yii::app()->getRequest()->getQuery('key', null);
        $user = User::model()->findByAttributes(array('activation_key' => $key));
        if (empty($user))
        {
            Yii::app()->user->setFlash('error_flash', 'Activation key expired or it has already been used');
            $this->redirect(array('login/'));
        } else
        {
            $user->status = 'Active';
            $user->activation_key = null;
            if ($user->update())
            {
                Yii::app()->user->setFlash('success_flash', 'Your account has been activated. You may login below now');
                $this->redirect(array('login/'));
            }
        }
    }

    public function actionRegistrationSuccessful()
    {
        $this->render('register_success');
    }

    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }


    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
