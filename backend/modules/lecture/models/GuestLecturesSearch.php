<?php

namespace backend\modules\lecture\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\lecture\models\GuestLectures;

/**
 * GuestLecturesSearch represents the model behind the search form of `backend\modules\lecture\models\GuestLectures`.
 */
class GuestLecturesSearch extends GuestLectures
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['letureId', 'speaker_id', 'createdBy', 'updatedBy'], 'integer'],
            [['topicname', 'apiUrl', 'createdDate', 'updatedDate','sem_id'], 'safe'],
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
        $query = GuestLectures::find();

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
            'letureId' => $this->letureId,
            'speaker_id' => $this->speaker_id,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'topicname', $this->topicname])
            ->andFilterWhere(['like', 'apiUrl', $this->apiUrl]);

        return $dataProvider;
    }
}
