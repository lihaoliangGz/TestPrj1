<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Country_2 */

$this->title = 'Create Country 2';
$this->params['breadcrumbs'][] = ['label' => 'Country 2s', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-2-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
