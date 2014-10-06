<?php

namespace webvimark\modules\banner\widgets\banner_widget;


use webvimark\modules\banner\models\Banner;
use yii\base\Widget;

class BannerWidget extends Widget
{
	public $id;

	public function run()
	{
		$banner = Banner::findOne($this->id);

		return $this->render('index', compact('banner'));
	}
} 