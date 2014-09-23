<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Article;
use common\models\User;

/**
 * ArticleSearch represents the model behind the search form about `common\models\Article`.
 */
class ArticleSearch extends Article
{
    public function rules()
    {
        return [
            [['aid', 'category_id', 'set_index', 'set_top', 'set_recommend', 'click_count', 'status', 'created_time', 'updated_time'], 'integer'],
            [['title', 'author_id', 'content', 'tags', 'keywords', 'summary'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
       // dump($params);die();
        $query = Article::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'aid' => $this->aid,
            'author_id' =>$this->author_id ? User::getIdByName($this->author_id) : $this->author_id,
            'category_id' => $this->category_id,
            'set_index' => $this->set_index,
            'set_top' => $this->set_top,
            'set_recommend' => $this->set_recommend,
            'click_count' => $this->click_count,
            'status' => $this->status,
            'created_time' => $this->created_time,
            'updated_time' => $this->updated_time,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'summary', $this->summary]);

        return $dataProvider;
    }
}
