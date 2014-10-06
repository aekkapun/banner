<?php

use yii\db\Migration;

class m141006_101821_add_position_to_banner extends Migration
{
	public function safeUp()
	{
		$this->addColumn('banner', 'position', 'int(1) not null default 1');
		Yii::$app->cache->flush();

	}

	public function safeDown()
	{
		$this->dropColumn('banner', 'position');
		Yii::$app->cache->flush();
	}
}
