<?php

class LoginController extends Controller {

    public $defaultAction = 'login';
    public $layout = '//layouts/column2';

    public function actionLogin()
    {
        $facebook_app = Yii::app()->commons->getFacebookApp();
        $facebook_url = 'https://www.facebook.com/dialog/oauth?client_id=' . $facebook_app['app_id'] . '&redirect_uri=' . Yii::app()->request->getBaseUrl(true) . '/login/facebook&scope=email';

        $linkedin_app = Yii::app()->commons->getLinkedInApp();
        $state = Yii::app()->getSecurityManager()->generateRandomString(25, false);
        $linkedin_url = "https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=" . $linkedin_app['client_id'] . "&scope=r_basicprofile%20r_emailaddress%20r_fullprofile&state=" . $state . "&redirect_uri=" . $linkedin_app['redirect_url'];

        $google_app = Yii::app()->commons->getGoogleApp();
        $google_url = "https://accounts.google.com/o/oauth2/auth?redirect_uri=" . $google_app['callback_url'] . "&response_type=code&client_id=" . $google_app['client_id'] . "&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&approval_prompt=force&access_type=offline";

        $login=new LoginForm();

        if (isset($_POST['LoginForm']))
        {
            $login->attributes = $_POST['LoginForm'];
            $login->social = false;
            $login->userType='Candidate';
            if ($login->login())
            {
                $this->redirect(array('candidate/'));
            }
            else
            {
                print_r($login->getErrors());
            }
        }

        $this->render('login', array( 'login' => $login, 'facebook_url' => $facebook_url, 'linkedin_url' => $linkedin_url, 'google_url' => $google_url));
    }

    public function actionFacebook()
    {
        $code = Yii::app()->getRequest()->getQuery('code', null);
        if ($code)
        {
            $facebook_app = Yii::app()->commons->getFacebookApp();
            $access_token_url = "https://graph.facebook.com/oauth/access_token?client_id=" . $facebook_app['app_id'] . "&redirect_uri=" . Yii::app()->request->getBaseUrl(true) . "/login/facebook&client_secret=" . $facebook_app['app_secret'] . "&code=" . $code;
            $access_token_details = file_get_contents($access_token_url);
            parse_str($access_token_details, $token_array);

            $user_info_url = "https://graph.facebook.com/me?access_token=" . $token_array['access_token'];
            $user_information = json_decode(file_get_contents($user_info_url), true);
            if (!empty($user_information))
                $this->actionSocialLogin($user_information, 'facebook');
        } else
        {
            $this->redirect(array('login/'));
        }
    }

    public function actionLinkedIn()
    {
        $code = Yii::app()->getRequest()->getQuery('code', null);
        if ($code)
        {
            $LinkedinApp = Yii::app()->commons->getLinkedInApp();
            $token_url = "https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code=" . $code . "&redirect_uri=" . $LinkedinApp['redirect_url'] . "&client_id=" . $LinkedinApp['client_id'] . "&client_secret=" . $LinkedinApp['secret_key'];
            $access_token = json_decode(@file_get_contents($token_url));
            $user_details = @file_get_contents($LinkedinApp['details_url'] . $access_token->access_token);

            $xml = simplexml_load_string($user_details);
            $json = json_encode($xml);
            $user_information = json_decode($json, TRUE);

            if (!empty($user_information))
                $this->actionSocialLogin($user_information, 'linkedin');
        } else
        {
            $this->redirect(array('login/'));
        }
    }

    public function actionGoogle()
    {
        $code = Yii::app()->request->getQuery('code', null);
        if ($code)
        {
            $google_app = Yii::app()->commons->getGoogleApp();
            $oauth2token_url = "https://accounts.google.com/o/oauth2/token";
            $clienttoken_post = array(
                "code" => $code,
                "client_id" => $google_app['client_id'],
                "client_secret" => $google_app['client_secret'],
                "redirect_uri" => $google_app['callback_url'],
                "grant_type" => "authorization_code"
            );

            $curl = curl_init($oauth2token_url);

            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $json_response = curl_exec($curl);
            curl_close($curl);
            $authObj = json_decode($json_response);
            
            $user_details_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=" . $authObj->access_token;
            $user_information = json_decode(file_get_contents($user_details_url), true);

            if (!empty($user_information))
                $this->actionSocialLogin($user_information, 'google');
        } else
        {
            $this->redirect(array('login/'));
        }
    }

    public function actionSocialLogin($user_information, $social_id)
    {
        $user = User::model()->findByAttributes(array('email' => $user_information['email']));
        if (empty($user))
        {
            $user = new User;
            $user->email = $user_information['email'];
            if ($social_id == "facebook")
            {
                $user->facebook_id = $user_information['id'];
            } elseif ($social_id == "linkedin")
            {
                $user->linkedin_id = $user_information['id'];
            } else
            {
                $user->google_id = $user_information['id'];
            }

            $user->status = 'Active';
            $user->role = 'member';
            if ($user->save(false))
            {
                $login = new LoginForm();
                $login->social = true;
                $login->email = $user_information['email'];
                if ($login->validate() && $login->login())
                {
                    $this->redirect(array('account/'));
                }
            }
        } else
        {
            $login = new LoginForm();
            $login->social = true;
            $login->email = $user['email'];
            if ($login->login())
            {
                $this->redirect(array('account/'));
            }
        }
    }

}
