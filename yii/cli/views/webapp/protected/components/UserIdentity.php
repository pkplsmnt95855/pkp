<?php

class UserIdentity extends CUserIdentity {

    private $_id;
    public $email;
    public $password;

    const ERROR_NONE = 0;
    const ERROR_USERNAME_INVALID = 1;
    const ERROR_PASSWORD_INVALID = 2;
    const ERROR_UNKNOWN_IDENTITY = 100;
    const ERROR_INACTIVE_ACCOUNT = 3;
    const ERROR_BLOCKED_ACCOUNT = 4;

    public function authenticate($social = false) {

     
        
        if ($social) {
            
        } else {
            $user = User::model()->findByAttributes(array("email" => $this->email, "password" => $this->password));

            if ($user) {
                if ($user->status == 'Inactive')
                    $this->errorCode = self::ERROR_INACTIVE_ACCOUNT;
                else {
                    $this->_id = $user->id;
                    $this->setState('roles', $user->role);
                    $this->errorCode = self::ERROR_NONE;
                }
            } else {

                $this->errorCode = self::ERROR_USERNAME_INVALID;
            }
        }

        return !$this->errorCode;
    }

    public function getId() {
        return $this->_id;
    }

}
