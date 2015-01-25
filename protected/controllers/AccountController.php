<?php

class AccountController extends Controller {

    public $layout = '//layouts/column2';

    public function actionIndex()
    {
        echo "My Account Section";
    }
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}
