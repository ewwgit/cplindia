<?php

namespace backend\modules\courses\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\courses\models\Courses;
use Yii;

/**
 * CoursesSearch represents the model behind the search form of `backend\modules\courses\models\Courses`.
 */
class CoursesSearch extends Courses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseId', 'sem_id', 'createdBy', 'updatedBy'], 'integer'],
            [['name', 'description', 'createdDate', 'updatedDate', 'status'], 'safe'],
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
    	if(Yii::$app->user->identity->role == 4)
    	{
    		$query = Courses::find()->where(['status'=>'Active']);
    	}
    	else{
        $query = Courses::find();
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
            'courseId' => $this->courseId,
            'sem_id' => $this->sem_id,
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
    public function searchAdmin($params)
    {
    	$query = Courses::find()->where(['sem_id'=>$params['id']]);
    
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
    	/* $query->andFilterWhere([
    			'courseId' => $this->courseId,
    			'sem_id' => $this->sem_id,
    			'createdBy' => $this->createdBy,
    			'updatedBy' => $this->updatedBy,
    			'createdDate' => $this->createdDate,
    			'updatedDate' => $this->updatedDate,
    	]);
    
    	$query->andFilterWhere(['like', 'name', $this->name])
    	->andFilterWhere(['like', 'description', $this->description])
    	->andFilterWhere(['like', 'status', $this->status]); */
    
    	return $dataProvider;
    }
}
