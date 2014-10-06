<?php

namespace webvimark\modules\banner\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use webvimark\modules\banner\models\Banner;

/**
 * BannerSearch represents the model behind the search form about `webvimark\modules\banner\models\Banner`.
 */
class BannerSearch extends Banner
{
	public function rules()
	{
		return [
			[['id', 'active', 'sorter', 'created_at', 'position', 'updated_at'], 'integer'],
			[['name', 'image', 'link'], 'safe'],
		];
	}

	public function scenarios()
	{
		// bypass scenarios() implementation in the parent class
		return Model::scenarios();
	}

	public function search($params)
	{
		$query = Banner::find();

		if ( ! \Yii::$app->request->get('sort') )
		{
			$query->orderBy('banner.sorter');
		}

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => \Yii::$app->request->cookies->getValue('_grid_page_size', 20),
			],
			'sort'=>[
				'defaultOrder'=>['id'=> SORT_DESC],
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
			'banner.id' => $this->id,
			'banner.active' => $this->active,
			'banner.sorter' => $this->sorter,
			'banner.position' => $this->position,
			'banner.created_at' => $this->created_at,
			'banner.updated_at' => $this->updated_at,
		]);

        	$query->andFilterWhere(['like', 'banner.name', $this->name])
			->andFilterWhere(['like', 'banner.link', $this->link]);

		return $dataProvider;
	}
}
