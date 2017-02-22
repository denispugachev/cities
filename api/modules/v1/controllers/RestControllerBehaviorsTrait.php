<?php

namespace api\modules\v1\controllers;

use yii\filters\auth\QueryParamAuth;
use yii\web\Response;

/**
 * Trait for overriding REST controllers behaviors.
 */
trait RestControllerBehaviorsTrait {
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