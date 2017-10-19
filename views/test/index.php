<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'description:ntext',
            'user_id',
            'date',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{pass} {view} {delete}',
                'buttons' => [
                    'pass' => function ($url, $model) {
                        $url = Url::to(['test/pass', 'id' => $model->id, 'questionIndex' => 0]);
                        return Html::a('<span class="glyphicon glyphicon-triangle-right"></span>', $url, ['title' => Yii::t('yii', 'Pass'), 'data-pjax' => '0']);
                    },
                    'view' => function ($url, $model) {
                        $url = Url::to(['test/view', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0']);
                    },
                    'delete' => function($url, $model) {
                        $url = Url::to(['test/delete', 'id' => $model->id]);
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => 'delete',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',]);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
