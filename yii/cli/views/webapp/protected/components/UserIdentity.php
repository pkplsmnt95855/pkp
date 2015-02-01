<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;
    public $email;
    public $password;

    /**
     * Authenticates a user.
     * The example implementation makes sure if the email and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        echo "tesdfsdst";exit;

        $user = User::model()->findByAttributes(array("email" => $this->email, "password" => $this->password));

        if ($employer)
        {
            if ($employer->status == 'Inactive')
            {
                $this->errorCode = self::ERROR_INACTIVE_ACCOUNT;
                
            } else
            {
                $this->_id = $employer->id;
                $this->errorCode = self::ERROR_NONE;
            }
        } else
            $this->errorCode = self::ERROR_USERNAME_INVALID;

        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

}
