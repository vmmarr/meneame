<?php

namespace app\models;

use Yii;

class Categorias extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'categorias';
    }

    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
}
