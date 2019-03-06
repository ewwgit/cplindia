<?php

namespace backend\modules\project\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\project\models\Project;
use Yii;

/**
 * ProjectSearch represents the model behind the search form of `backend\modules\project\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['projectId', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'description', 'from_date', 'to_date', 'createdDate', 'updatedDate', 'status'], 'safe'],
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
    	if(Yii::$app->user->identity->role == 4){
        $query = Project::find()->where(['status'=>'Active']);
    	}else{
    		$query = Project::find();
    	}

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
            'projectId' => $this->projectId,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
