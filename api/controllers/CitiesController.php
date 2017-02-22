<?php

namespace api\controllers;


use common\models\City;
use common\models\CityRest;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Cities REST controller.
 */
class CitiesController extends ActiveController
{
    /** {@inheritDoc} */
    public $modelClass = CityRest::class;

    /**
     * Override method for changing ContentNegotiator and Authenticator configs.
     *
     * {@inheritDoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats'] = [
            'application/json' => Response::FORMAT_JSON,
        ];

        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];

        return $behaviors;
    }
}