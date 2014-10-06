<?php
/**
 * @var $this yii\web\View
 * @var $banner webvimark\modules\banner\models\Banner
 */
use webvimark\modules\banner\models\Banner;
use yii\helpers\Html;
use yii\helpers\Url;

$imageSize = [
	Banner::POSITION_CENTER        => 'full',
	Banner::POSITION_SIDE          => 'medium',
	Banner::POSITION_HEADER_FOOTER => 'full',
];

$wrapperClass = [
	Banner::POSITION_CENTER        => 'banner-widget-center',
	Banner::POSITION_SIDE          => 'banner-widget-side',
	Banner::POSITION_HEADER_FOOTER => 'banner-widget-header-footer',
];
?>
<div class="<?= $wrapperClass[$banner->position] ?>">
	<?php if ( $banner->link ): ?>
		<?= Html::a(
			Html::img(
				$banner->getImageUrl($imageSize[$banner->position]),
				['class'=>'img-responsive', 'alt'=>$banner->name]
			),
			Url::to($banner->link)
		) ?>
	<?php else: ?>
		<?= Html::img(
			$banner->getImageUrl($imageSize[$banner->position]),
			['class'=>'img-responsive', 'alt'=>$banner->name]
		) ?>
	<?php endif; ?>

</div>


