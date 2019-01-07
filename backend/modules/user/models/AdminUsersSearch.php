<?php

namespace backend\modules\user\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\user\models\AdminUsers;

/**
 * AdminUsersSearch represents the model behind the search form of `backend\modules\user\models\AdminUsers`.
 */
class AdminUsersSearch extends AdminUsers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['aduserId', 'userId', 'createdBy', 'updatedBy'], 'integer'],
            [['first_name', 'last_name', 'mobile', 'profileImage', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = AdminUsers::find();

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
            'aduserId' => $this->aduserId,
            'userId' => $this->userId,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'profileImage', $this->profileImage]);

        return $dataProvider;
    }
}
