<?php


namespace backend\models;


use common\entities\UsersWords;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class MegaUsersWordsSearch extends UsersWords
{
    public $word_content;
    public $word_order;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'word_id', 'count', 'order', 'status'], 'integer'],
            [['word_count', 'word_order', 'word'], 'safe']
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

        // Important: lets join the query with our previously mentioned relations
        // I do not make any other configuration like aliases or whatever, feel free
        // to investigate that your self
        $query->joinWith(['word']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "WordSearch" instance
        $dataProvider->sort->attributes['word_order'] = [
            // The tables are the ones our relation are configured to
            'asc' => ['word.order' => SORT_ASC],
            'desc' => ['word.order' => SORT_DESC],
        ];

        // Important: here is how we set up the sorting
        // The key is the attribute name on our "WordSearch" instance
        $dataProvider->sort->attributes['word_content'] = [
            // The tables are the ones our relation are configured to
            'asc' => ['word.content' => SORT_ASC],
            'desc' => ['word.content' => SORT_DESC],
        ];

        /*$word_count = null;
        if (isset($params['MegaUsersWordsSearch']) && isset($params['MegaUsersWordsSearch']['word'])) {
            $word_count = $params['MegaUsersWordsSearch']['word'];
            unset($params['MegaUsersWordsSearch']['word']);
        }*/
        // No search? Then return data Provider
        if (!$this->load($params) && !$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'word_id' => $this->word_id,
            'order' => $this->order,
            'status' => $this->status,
        ]);
        // Here we search the attributes of our relations using our previously configured
        // ones in "WordSearch"
        /*if ($word_count && $word_count != '') {

        }*/
        $query->andFilterWhere(['word.order' => $this->word_order]);
        $query->andFilterWhere(['word.content' => $this->word_content]);

        return $dataProvider;
    }
}
