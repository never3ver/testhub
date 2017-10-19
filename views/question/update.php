<?php

use app\models\Test;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */


$this->title = 'Update Question';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ["test/index"]];
$this->params['breadcrumbs'][] = ['label' => 'Test', 'url' => ['test/view', 'id' => $model->test_id]];
$this->params['breadcrumbs'][] = ['label' => 'Question', 'url' => ['question/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'answers' => $answers,
    ])
    ?>

</div>
