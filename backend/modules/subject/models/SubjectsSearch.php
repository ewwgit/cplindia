<?php

namespace backend\modules\subject\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\subject\models\Subjects;
use Yii;

/**
 * SubjectsSearch represents the model behind the search form of `backend\modules\subject\models\Subjects`.
 */
class SubjectsSearch extends Subjects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subId','courseId','createdBy', 'updatedBy'], 'integer'],
            [['name','courseId','description','createdDate', 'updatedDate'], 'safe'],
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
        $query = Subjects::find()->where(['status'=>'Active']);
    	}else{
    		$query = Subjects::find();
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
            'subId' => $this->subId,
            'createdBy' => $this->createdBy,
            'updatedBy' => $this->updatedBy,
            'createdDate' => $this->createdDate,
            'updatedDate' => $this->updatedDate,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);
           ;

        return $dataProvider;
    }
    public function searchAdmin($params)
    {
    	$query = Subjects::find()->where(['courseId'=>$params['id']]);
    
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
