<?php

namespace frontend\modules\user\controllers;

use common\models\File;
use common\models\ProductCategory;
use common\models\ProductCelebration;
use common\models\ProductFormat;
use common\models\ProductSection;
use phpDocumentor\Reflection\Project;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, [
            'user_id'=>\Yii::$app->user->identity->id
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {

            $model->user_id = \Yii::$app->user->identity->id;
            $model->shop_id = \Yii::$app->user->identity->shop->id;
            $model->is_active = 1;

            if($model->save())
            {
                $productCategory = new ProductCategory();
                $productCategory->product_id = $model->id;
                $productCategory->category_id = $model->category_id;
                $productCategory->category_main_id = $model->category_main_id;
                $productCategory->save();

                if(!empty($model->productFormat))
                    $model->productFormat->delete();

                $productFormat = new ProductFormat();
                $productFormat->product_id = $model->id;
                $productFormat->format_id = $model->format_id;
                $productFormat->save();


                if(!empty($model->productCelebrations))
                    $model->productCelebrations->delete();

                $productCelebrations = new ProductCelebration();
                $productCelebrations->product_id = $model->id;
                $productCelebrations->celebration_id = $model->celebration_id;
                $productCelebrations->save();


                $file = new File();
                $file->objectsList = UploadedFile::getInstances($model, 'attachments');

                if(!empty($file->objectsList))
                {
                    $file->upload(
                        $model->id,
                        File::OBJECT_TYPE_PRODUCT,
                        '',
                        File::FILE_TYPE_PICTURE
                    );
                }

                $file = new File();
                $file->objectsList = UploadedFile::getInstances($model, 'resources');

                if(!empty($file->objectsList))
                {
                    File::deleteFile(\Yii::$app->params['productResource'], $model->id, File::OBJECT_TYPE_PRODUCT_RESOURCE);

                    $file->upload(
                        $model->id,
                        File::OBJECT_TYPE_PRODUCT_RESOURCE,
                        '',
                        File::FILE_TYPE_OTHERS
                    );


                }

                return $this->redirect(['update', 'id'=>$model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $file = new File();
            $file->objectsList = UploadedFile::getInstances($model, 'attachments');

            if(!empty($model->productCategory))
                $model->productCategory->delete();

            $productCategory = new ProductCategory();
            $productCategory->product_id = $model->id;
            $productCategory->category_id = $model->category_id;
            $productCategory->category_main_id = $model->category_main_id;
            $productCategory->save();

            /*
            if(!empty($model->productSection))
                $model->productSection->delete();

            $productSection = new ProductSection();
            $productSection->product_id = $model->id;
            $productSection->section_id = $model->section_id;
            $productSection->save();
            */


            if(!empty($model->productFormat))
                $model->productFormat->delete();

            $productFormat = new ProductFormat();
            $productFormat->product_id = $model->id;
            $productFormat->format_id = $model->format_id;
            $productFormat->save();


            if(!empty($model->productCelebrations))
                $model->productCelebrations->delete();

            $productCelebrations = new ProductCelebration();
            $productCelebrations->product_id = $model->id;
            $productCelebrations->celebration_id = $model->celebration_id;
            $productCelebrations->save();



            /*$productSection = new ProductSection();
            $productSection->product_id = $model->id;
            $productSection->section_id = $model->section_id;
            */

            if(!empty($file->objectsList))
            {
                $file->upload(
                    $model->id,
                    File::OBJECT_TYPE_PRODUCT,
                    '',
                    File::FILE_TYPE_PICTURE
                );
            }


            $file = new File();
            $file->objectsList = UploadedFile::getInstances($model, 'resources');

            if(!empty($file->objectsList))
            {
                File::deleteFile(\Yii::$app->params['productResource'], $model->id, File::OBJECT_TYPE_PRODUCT_RESOURCE);

                $file->upload(
                    $model->id,
                    File::OBJECT_TYPE_PRODUCT_RESOURCE,
                    '',
                    File::FILE_TYPE_OTHERS
                );


            }


            return $this->redirect(['update', 'id'=>$model->id]);
        }
        else{



            $model->category_id = !empty($model->productCategory) ? $model->productCategory->category_id:'';
            $model->category_main_id = !empty($model->productCategory) ? $model->productCategory->category_main_id:'';

            //!empty($model->productCategory) && !empty($model->productCategory->category->parent) ? $model->productCategory->category->parent->id:'';

            $model->section_id = !empty($model->productSection) ? $model->productSection->section_id:'';
            $model->format_id = !empty($model->productFormat) ? $model->productFormat->format_id:'';
            $model->celebration_id = !empty($model->productCelebrations) ? $model->productCelebrations->celebration_id:'';
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionActive($id)
    {
        $model = $this->findModel($id);

        $model->is_active = $model->is_active == 1 ? 0:1;
        $model->save(false);

        return $this->redirect(['index']);
    }

    public function actionCopy($id)
    {
        $model = $this->findModel($id);

        $newModel = new Product();

        foreach ($model->attributes as $key=>$value)
        {
            if(!in_array($key, ['id', 'created_at', 'updated_at']))
                $newModel->$key = $value;
        }
        $newModel->save();

        return $this->redirect(['index']);
    }

    public function actionFileDelete($id)
    {
        $model = File::findOne($id);

        $id = $model->object_id;

        $model->delete();
        return $this->redirect(['update', 'id'=>$id]);
    }

    public function actionFileSetPrimery($id)
    {
        $file = File::findOne($id);
        
        File::updateAll(['sort'=>100], [
            'object_id'=>$file->object_id,
            'object_type'=>$file->object_type,
        ]);

        $file->sort=0;
        $file->save();

        return $this->redirect(['update', 'id'=>$file->object_id]);

    }




    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
