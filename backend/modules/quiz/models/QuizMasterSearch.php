<?php

namespace backend\modules\quiz\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\quiz\models\QuizMaster;

/**
 * QuizMasterSearch represents the model behind the search form of `backend\modules\quiz\models\QuizMaster`.
 */
class QuizMasterSearch extends QuizMaster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quizId', 'sem_id', 'courseId', 'totalMarks', 'passMarks', 'eachquestioncarries', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'description', 'validFrom', 'validTime', 'quizTime', 'status', 'createdDate', 'updatedDate'], 'safe'],
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
        $query = QuizMaster::find();

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
            'quizId' => $this->quizId,
            'sem_id' => $this->sem_id,
            'courseId' => $this->courseId,
            'validFrom' => $this->validFrom,
            'validTime' => $this->validTime,
            'totalMarks' => $this->totalMarks,
            'passMarks' => $this->passMarks,
            'eachquestioncarries' => $this->eachquestioncarries,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'quizTime', $this->quizTime])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
