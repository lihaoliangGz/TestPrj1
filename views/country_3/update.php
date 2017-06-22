<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Country_2 */

$this->title = 'Update Country 2: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Country 2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-2-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
