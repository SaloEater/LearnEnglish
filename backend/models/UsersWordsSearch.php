<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\entities\UsersWords;

/**
 * UsersWordsSearch represents the model behind the search form of `common\entities\UsersWords`.
 */
class UsersWordsSearch extends UsersWords
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'word_id', 'count', 'order', 'status'], 'integer'],
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
        $query = UsersWords::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'word_id' => $this->word_id,
            'count' => $this->count,
            'order' => $this->order,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
