<?php

namespace app\controllers;

use app\models\Categorias;
use app\models\CategoriasSearch;
use Yii;
use yii\data\Pagination;
use yii\data\Sort;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CategoriasController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $categoriasSearch = new CategoriasSearch();
    
        $dataProvider = $categoriasSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categoriasSearch' => $categoriasSearch,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findCategoria($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Categorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findCategorias($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findCategoria($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Fila borrada con éxito.');
        return $this->redirect(['index']);
    }

    protected function findCategoria($id)
    {
        if (($categoria = Categorias::findOne($id)) === null) {
            throw new NotFoundHttpException('No se ha encontrado el género.');
        }

        return $categoria;
    }
}