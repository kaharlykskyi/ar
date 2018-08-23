<?php
namespace frontend\modules\user\controllers;

use common\models\Brand;
use common\models\Category;
use common\models\Color;
use common\models\Favorite;
use common\models\search\FavoriteSearch;
use common\models\Size;
use common\models\Tag;
use frontend\models\ProductSearch;
use yii\web\Controller;

/**
 * Class SearchController
 * @package frontend\controllers
 */
class FavoriteController extends UserController
{
    /**
     * Страница поиска по категориям.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FavoriteSearch();
        $dataProvider = $searchModel->search("", [
            'user_id'=>\Yii::$app->user->identity->id
        ]);

        return $this->render('index', [
            'model' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionAdd()
    {
        $product_id = \Yii::$app->request->post('id');

        $model = Favorite::find()->where('user_id=:user_id and product_id=:product_id', [
            ':user_id'=>\Yii::$app->user->id,
            ':product_id'=>$product_id
        ])->one();
            
        if(!isset($model->id))
        {
            $model = new Favorite();
            $model->attributes = [
                'user_id'=>\Yii::$app->user->id,
                'product_id'=>$product_id
            ];
            $model->save();
        }
        
        echo json_encode([
            'status'=>'success'
        ]);
        \Yii::$app->end();
    }

    public function actionRemove()
    {
        $product_id = \Yii::$app->request->post('id');

        Favorite::deleteAll('user_id=:user_id and product_id=:product_id', [
            ':user_id'=>\Yii::$app->user->id,
            ':product_id'=>$product_id
        ]);

        echo json_encode([
            'status'=>'success'
        ]);
        \Yii::$app->end();
    }



    public function actionView($id)
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search([
            'ProductSearch'=>[
                'category_id'=>$id
            ]
        ]);

        $categoryModel = Category::findOne($id);

        return $this->render('//search/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryModel' => $categoryModel,
            'tpl'=>'category'
//            'tags' => [],
//            'colors' => [],
//            'sizes' => [],
//            'brands' => Brand::find()->asArray()->all(),
        ]);
    }


}
