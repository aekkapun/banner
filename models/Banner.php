<?php

namespace webvimark\modules\banner\models;

use webvimark\modules\content\models\PageWidget;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;

/**
 * This is the model class for table "banner".
 *
 * @property integer $id
 * @property integer $active
 * @property integer $sorter
 * @property integer $position
 * @property string $name
 * @property string $image
 * @property string $link
 * @property integer $created_at
 * @property integer $updated_at
 */
class Banner extends \webvimark\components\BaseActiveRecord
{
	const WIDGET_CLASS = 'webvimark\modules\banner\widgets\banner_widget\BannerWidget';

	const POSITION_CENTER = 0;
	const POSITION_SIDE = 1;
	const POSITION_HEADER_FOOTER = 2;

	/**
	 * getPositionList
	 * @return array
	 */
	public static function getPositionList()
	{
		return [
			self::POSITION_SIDE          => 'Сбоку',
			self::POSITION_CENTER        => 'По центру',
			self::POSITION_HEADER_FOOTER => 'Сверху-снизу',
		];
	}

	/**
	 * getPositionValue
	 *
	 * @param string $val
	 *
	 * @return string
	 */
	public static function getPositionValue($val)
	{
		$ar = self::getPositionList();

		return isset( $ar[$val] ) ? $ar[$val] : $val;
	}

	/**
	* @inheritdoc
	*/
	public static function tableName()
	{
		return 'banner';
	}

	/**
	* @inheritdoc
	*/
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}

	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			[['active', 'sorter', 'position', 'created_at', 'updated_at'], 'integer'],
			[['name', 'image'], 'required'],
			[['name', 'link'], 'string', 'max' => 255],
			[['image'], 'image', 'maxSize' => 1024*1024*5]
		];
	}

	/**
	* @inheritdoc
	*/
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'active' => 'Активно',
			'sorter' => 'Порядок',
			'name' => 'Название',
			'image' => 'Изображение',
			'link' => 'Ссылка',
			'position' => 'Расположение',
			'created_at' => 'Создано',
			'updated_at' => 'Обновлено',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function afterDelete()
	{
		$this->bulkDeleteImages(['image']);

		PageWidget::deleteIfExists([
			'class'   => self::WIDGET_CLASS,
			'options' => serialize(['id' => $this->id]),
		]);

		Yii::$app->cache->flush();

		parent::afterDelete();
	}

	/**
	 * Create page_widget or update it's name
	 *
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		if ( $insert )
		{
			$widget = new PageWidget();

			$widget->name         = $this->name;
			$widget->position     = $this->position;
			$widget->description  = 'Баннер';
			$widget->is_internal  = 1;
			$widget->class        = self::WIDGET_CLASS;
			$widget->options      = serialize(['id' => $this->id]);
			$widget->has_settings = 1;
			$widget->settings_url = Url::to(['/banner/banner/update', 'id'=>$this->id]);

			$widget->save(false);
		}
		elseif ( array_key_exists('name', $changedAttributes) OR array_key_exists('position', $changedAttributes) )
		{
			$widget = PageWidget::findOne([
				'class'   => self::WIDGET_CLASS,
				'options' => serialize(['id' => $this->id]),
			]);

			if ( $widget )
			{
				$widget->name = $this->name;
				$widget->position = $this->position;
				$widget->save(false);
			}
		}

		parent::afterSave($insert, $changedAttributes);
	}
}
