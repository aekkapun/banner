<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\banner\models\Banner $model
 */

$this->title = 'Создание баннер';
$this->params['breadcrumbs'][] = ['label' => 'Баннера', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

	<div class="panel panel-default">
		<div class="panel-heading">
			<strong>
				<span class="glyphicon glyphicon-th"></span> <?= Html::encode($this->title) ?>
			</strong>
		</div>
		<div class="panel-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
