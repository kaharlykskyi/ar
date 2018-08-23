<?php

namespace backend\controllers;

use backend\controllers\CController;
use common\components\CFormatter;
use common\components\CMail;
use common\components\controllers\RbacController;
use common\models\AuthItem;
use common\models\File;
use Yii;
use common\models\User;
use common\models\search\UserSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    /*
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
    */


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, [
            'role_id'=>User::ROLE_USER
        ]);

        $ind = 0;
        foreach ($dataProvider->getModels() as $item) {
            // Publish
            $dataProvider->getModels()[$ind]['columnAccess'] = '<input data-size="mini" data-label-width="0" class="switcher" href-data="'.Url::to(['/user/update', 'id'=>$item->id]).'"  type="checkbox" name="User[access]" ' . ($item->access == 1 ? 'checked' : '') . '>';
            $ind++;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role_id' => ''
        ]);
    }


    public function actionApplicant()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(
            Yii::$app->request->queryParams,
            [
                'role_id' => User::ROLE_APPLICANT,
                'access' => User::ACCESS_FULL
            ]
        );

        $ind = 0;
        foreach ($dataProvider->getModels() as $item) {
            // Publish
            // $dataProvider->getModels()[$ind]['columnAccess'] = '<input data-size="mini" data-label-width="0" class="switcher" href-data="/index.php?r=/adminpanel/user/update&id='.$item->id.'"  type="checkbox" name="User[access]" '.($item->access==1 ? 'checked':'').'>';

            $dataProvider->getModels()[$ind]['columnStatus'] = '<input data-size="mini" data-label-width="0" class="switcher" href-data="/index.php?r=/adminpanel/user/update&id=' . $item->id . '"  type="checkbox" value="' . ($item->status == 5 ? '10' : '5') . '" name="User[status]" ' . ($item->status == 10 ? 'checked' : '') . '>';
            $ind++;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role_id' => User::ROLE_APPLICANT
        ]);
    }

    public function actionChangeCourier($id){
        $model = $this->findModel($id);

        if($model->role_id == User::ROLE_APPLICANT)
        {
            $authItem = new AuthItem();

            $model->role_id = User::ROLE_COURIER;
            $model->def_avatar_file_id = $authItem->getDefAvatar(User::ROLE_COURIER)['id'];
            $model->save(false);
        }

        echo json_encode(array('status' => 'ok'));
        Yii::$app->end();
    }



    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    public function actionDocument()
    {
        $user_id = \Yii::$app->request->get('user_id');

        $model = User::findOne($user_id);
        
        return $this->render('document', [
            'model' => $model
        ]);
        //getApplicantAttacheDocument
    }


    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            if($model->email == "")
                $model->email = CFormatter::generationEmail();


            if($model->save())
            {

                \Yii::$app->session->setFlash('success', \Yii::t('app', 'Profile update'));
                return $this->redirect(['index', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $oldStatus = $model->status;
        if ($model->load(Yii::$app->request->post())) {

            if($model->email == "")
                $model->email = CFormatter::generationEmail();

            if(isset(Yii::$app->request->post()['action-type']) && Yii::$app->request->post()['action-type'] == 'ajax')
            {
                if($model->save(false)) {

                    /*
                    if($oldStatus == "5" && $model->status=="10")
                    {
                        $mail = new CMail();
                        $mail->send([
                            'alias'=>'signup',
                            'model'=>$model,
                            'to'=>$model->email,
                            'subject'=>\Yii::t('app', 'Signup'),
                        ]);
                    }
                    */

                    echo json_encode(array('status' => 'ok'));
                    Yii::$app->end();
                }
            }
            else
            {
                if($model->save()) {
                    if($model->password_admin!="")
                    {
                        $model->setPassword($model->password_admin);
                        $model->save();
                    }

                    
                    \Yii::$app->session->setFlash('success', \Yii::t('app', 'Your Profile changed'));
                    return $this->redirect(['index']);
                }
            }


        }


        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionComment($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save(false)) {
            \Yii::$app->session->setFlash('success', \Yii::t('app', 'Comment saved'));

            return $this->redirect(Yii::$app->request->referrer);
            // return $this->redirect(['index']);
        }

        return $this->renderPartial('comment', [
            'model' => $model,
        ]);
    }

    public function actionApplication($id)
    {
        $model = $this->findModel($id);

        return $this->renderPartial('application', [
            'model' => $model,
        ]);
    }


    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
