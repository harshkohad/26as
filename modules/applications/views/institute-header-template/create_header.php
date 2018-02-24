<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
$form = ActiveForm::begin(['id' => 'create_command', 'action' => 'save-header']);
?>

<div class="container text-center">
    <table class="table table-bordered pagin-table">
        <thead>
            <tr>
                <th  width="220px">Header</th>
                <th width="220px">Fields</th width="220px">

            </tr>
        </thead>
        <tbody>
            <tr>
                <td><div class="form-group">
                        <?= $form->field($model, 'header[]')->textInput(['maxlength' => 255, 'class' => 'form-control']); ?>
                    </div></td>
                <td><?= $form->field($model, 'fields[]')->textInput(['maxlength' => 255, 'class' => 'form-control', "id" => "tokeninput"]); ?>
                <td><div class="col-lg-12" style="text-align: right;">
                        <?= Html::submitButton('Add', ['class' => 'btn btn-success', 'id' => 'next_button']) ?>
                    </div></td>
            </tr>
        </tbody>
    </table>

</div>
<?php ActiveForm::end(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('tbody').sortable();
        $("#tokeninput").tokenInput([
            {id: 7, name: "Ruby"},
            {id: 11, name: "Python"},
            {id: 13, name: "JavaScript"},
            {id: 17, name: "ActionScript"},
            {id: 19, name: "Scheme"},
            {id: 23, name: "Lisp"},
            {id: 29, name: "C#"},
            {id: 31, name: "Fortran"},
            {id: 37, name: "Visual Basic"},
            {id: 41, name: "C"},
            {id: 43, name: "C++"},
            {id: 47, name: "Java"}
        ], {
            theme: "facebook",
            hintText: "I can has tv shows?",
            noResultsText: "O noes",
            searchingText: "Meowing..."
        });

    });

</script>

<style>
    .table {
        width: 69%;
        max-width: 100%;
        margin-bottom: 20px;
    }
</style>