<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;

/**
 * ArticleSearch represents the model behind the search form of `common\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'created_by', 'updated_by', 'status'], 'integer'],
            [['title', 'content' , 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Article::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(\Yii::$app->user->can('author')){
            $query->andWhere(['created_by' => \Yii::$app->user->id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        if ($this->created_at) {
            $startTime = strtotime($this->created_at.' 00:00:00');
            $endTime = strtotime($this->created_at.' 23:59:59');
            $query->andWhere(['between', 'created_at', $startTime, $endTime]);
        }

        $query->orderBy(['created_at' => SORT_DESC]);

        return $dataProvider;
    }
}
