<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Lista de Usuarios';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1><?= Html::encode($this->title) ?></h1>

<?= GridView::widget([
    'dataProvider' => new \yii\data\ArrayDataProvider(['allModels' => $users]),
    'columns' => [
        'id',
        'person.per_name',
        'person.per_lastname_paternal',
        'person.per_lastname_maternal',
        'address.add_street',
        'address.add_exterior',

    ],
]); ?>