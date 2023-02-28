<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index card card-outline card-secondary">

    <div class="card-header card-title-group">

        <div class="card-title"><h4><?= Html::encode($this->title); ?> </h4></div>
        <div class="card-tools">
            <?= Html::a('<em class="icon fas fa-plus-circle"></em><span>'
                . Yii::t('rbac-admin', 'Create ' . $labels['Item']) . '</span>',
                [ 'create' ],
                [ 'class' => 'btn btn-md btn-primary' ]
            ) ?>
        </div>
    </div>

    <div class="card-body pt-3 pl-0 pr-0">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [ 'class' => 'yii\grid\SerialColumn' ],
                [
                    'attribute' => 'name',
                    'label' => Yii::t('rbac-admin', 'Name'),
                ],
                [
                    'attribute' => 'ruleName',
                    'label' => Yii::t('rbac-admin', 'Rule Name'),
                    'filter' => $rules
                ],
                [
                    'attribute' => 'description',
                    'label' => Yii::t('rbac-admin', 'Description'),
                ],
                [ 'class' => 'yii\grid\ActionColumn', ],
            ],
        ])
        ?>
    </div>

</div>
