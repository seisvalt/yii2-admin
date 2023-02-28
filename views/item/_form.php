<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

use mdm\admin\components\RouteRule;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form card">
    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'id' => 'item-form',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-3 text-right',
                'offset' => 'offset-sm-3',
                'wrapper' => 'col-sm-9',
            ],
        ]
    ]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>

            <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row text-right">
        <div class="col-md-12">
        <?php
        echo Html::submitButton('<em class="icon fas fa-save"></em><span>' . ($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update') ). '</span>', [
            'class' => 'btn btn-outline-' . ($model->isNewRecord ? 'success' : 'primary'),
            'name' => 'submit-button'])
        ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
