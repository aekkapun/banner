<?php

use webvimark\modules\banner\models\Banner;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\banner\models\Banner $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>
<div class="banner-form">

	<?php $form = ActiveForm::begin([
		'id'=>'banner-form',
		'layout'=>'horizontal',
			'options'=>[
			'enctype'=>"multipart/form-data",
		]
		]); ?>

	<?= $form->field($model->loadDefaultValues(), 'active')->checkbox(['class'=>'b-switch'], false) ?>

	<?= $form->field($model, 'name')->textInput(['maxlength' => 255, 'autofocus'=>$model->isNewRecord ? true:false]) ?>

	<?php if ( ! $model->isNewRecord AND is_file($model->getImagePath('medium', 'image'))): ?>
		<div class='form-group'>
			<div class='col-sm-3'></div>
			<div class='col-sm-6'>
				<?= Html::img($model->getImageUrl('medium', 'image'), ['alt'=>'image']) ?>
			</div>
		</div>
	<?php endif; ?>

	<?= $form->field($model, 'image', ['enableClientValidation'=>false, 'enableAjaxValidation'=>false])->fileInput(['class'=>'form-control']) ?>

	<?= $form->field($model, 'position')->dropDownList(Banner::getPositionList()) ?>

	<?= $form->field($model, 'link')->textInput(['maxlength' => 255])
		->hint('Оставьте поле пустым, если хотите, чтобы картинка не была ссылкой') ?>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<?php if ( $model->isNewRecord ): ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-plus-sign"></span> Создать',
					['class' => 'btn btn-success']
				) ?>
			<?php else: ?>
				<?= Html::submitButton(
					'<span class="glyphicon glyphicon-ok"></span> Сохранить',
					['class' => 'btn btn-primary']
				) ?>
			<?php endif; ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<?php BootstrapSwitch::widget() ?>