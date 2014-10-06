<?php

namespace webvimark\modules\banner\controllers;

use Yii;
use webvimark\modules\banner\models\Banner;
use webvimark\modules\banner\models\search\BannerSearch;
use webvimark\components\AdminDefaultController;
use yii\filters\VerbFilter;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends AdminDefaultController
{
	/**
	 * @var Banner
	 */
	public $modelClass = 'webvimark\modules\banner\models\Banner';

	/**
	 * @var BannerSearch
	 */
	public $modelSearchClass = 'webvimark\modules\banner\models\search\BannerSearch';

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}
}
