<?php

class AjaxController extends Controller {


    public function actionGetMaxSalaries() {

        $minSalary = Yii::app()->request->getPost('minSalary');
        $maximumSalaries = Yii::app()->postjob->getMaximumSalaries();

        foreach ($maximumSalaries as $key => $value) {
            if ($key <= $minSalary)
                unset($maximumSalaries[$key]);
        }

        $return = "<option value>Max. Salary</option>";
        foreach ($maximumSalaries as $key => $value) {
            $return.="<option value='" . $key . "'>" . $value . "</option>";
        }
        echo $return;
    }

    public function actionGetMinSalaries() {

        $maxSalary = Yii::app()->request->getPost('maxSalary');
        $minimumSalaries = Yii::app()->postjob->getMinimumSalaries();

        foreach ($minimumSalaries as $key => $value) {
            if ($key >= $maxSalary)
                unset($minimumSalaries[$key]);
        }

        $return = "<option value>Min. Salary</option>";
        foreach ($minimumSalaries as $key => $value) {
            $return.="<option value='" . $key . "'>" . $value . "</option>";
        }
        echo $return;
    }


}
