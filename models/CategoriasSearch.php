<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

class CategoriasSearch extends Categorias
{
    public function rules()
    {
        return [
            [['nombre'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Categorias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => [
                    'nombre' => [
                        'label' => 'Categoria',
                    ],
                ],
            ],
        ]);

        $this->load($params);
     
        if (!$this->validate()) {
            $query->where('1 = 0');
            return $dataProvider;
        }

        $query->andFilterWhere(['ilike', 'nombre', $this->denom]);

        return $dataProvider;
    }
}