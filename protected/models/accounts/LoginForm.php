<?php

class LoginForm extends CFormModel {

    public $email;
    public $password;
    public $social;
    private $_identity;

    public function rules()
    {
        return array(
            array('email,password', 'required'),
            array('password', 'authenticate'),
        );
    }

    public function authenticate($attribute, $params)
    {

        if (!$this->hasErrors())
        {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate($this->social);

            if ($this->_identity->errorCode === UserIdentity::ERROR_INACTIVE_ACCOUNT)
                $this->addError('password', 'You have not activated your account. Please check your email for activation from us to activate your account. <br/> <a href="' . Yii::app()->request->baseUrl . '/site/resendactivation">Click here to resend activation email</a>');

            if ($this->_identity->errorCode === UserIdentity::ERROR_BLOCKED_ACCOUNT)
                $this->addError('password', 'Your account is blocked by administrator, please contact admin at <a href="mailto:support@resumemarket.com">mailto:support@resumemarket.com</a>');


            if ($this->_identity->errorCode === UserIdentity::ERROR_PASSWORD_INVALID || $this->_identity->errorCode === UserIdentity::ERROR_USERNAME_INVALID)
                $this->addError('password', 'Incorrect email or password entered. Please try again');
        }
    }

    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate($this->social);
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            Yii::app()->user->login($this->_identity);
            return true;
        } else
            return false;
    }
    

}
