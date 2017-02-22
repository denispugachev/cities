<?php

namespace api\modules\v1\controllers;

use api\models\AddressSearchRequest;
use Yii;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use yii\web\ServerErrorHttpException;

/**
 * Address REST controller.
 */
class AddressController extends Controller
{
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

    /**
     * Main action.
     *
     * @return array
     * @throws BadRequestHttpException
     * @throws ServerErrorHttpException
     */
    public function actionIndex()
    {
        $addressSearchRequest = new AddressSearchRequest();
        $addressSearchRequest->load(Yii::$app->getRequest()->getQueryParams(), '');
        if ($addressSearchRequest->validate() === false) {
            throw new BadRequestHttpException();
        }

        try {
            return ['result' => $addressSearchRequest->execute()];
        } catch (\Exception $e) {
            $this->logError($e);
        } catch (\Throwable $e) {
            $this->logError($e);
        }
        throw new ServerErrorHttpException();
    }

    /**
     * Logs exception data.
     *
     * @param \Exception|\Throwable $exception
     */
    protected function logError($exception)
    {
        Yii::error([
            'message' => $exception->getMessage(),
            'class' => get_class($exception),
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}