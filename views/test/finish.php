<?php

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $model app\models\Test */

$this->title = 'Test completed';
$this->params['breadcrumbs'][] = ['label' => 'Tests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="test-finish">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php
    if ($correct == $count) {
        echo 'All answers are correct';
    } else {
        echo'You answered correctly at ' . $correct . ' question(s). The wrong ones were:';
        echo ListView::widget([
            'dataProvider' => $dataProvider,
            'summary' => '',
            'itemView' => '_finish',
        ]);
    }
    ?>
</div>

<?=Html::a('Return to main page', ['/'],['class'=>'btn btn-info'])?>