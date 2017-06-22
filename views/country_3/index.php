<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Country_3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Country 2s';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-2-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country 2', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
