<?php

use yii\db\Schema;
use yii\db\Migration;

class m140809_083656_create_banner_table extends Migration
{
	public function safeUp()
	{
		$tableOptions = null;
		if ( $this->db->driverName === 'mysql' )
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('banner', array(
			'id'         => 'pk',
			'active'     => 'tinyint(1) not null default 1',
			'sorter'     => 'int not null',
			'name'       => 'string not null',
			'image'      => 'string not null',
			'link'       => 'string not null',
			'created_at' => 'int not null',
			'updated_at' => 'int not null',
		), $tableOptions);

	}

	public function safeDown()
	{
		$this->dropTable('banner');
	}
}
