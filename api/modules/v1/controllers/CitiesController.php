<?php

namespace api\modules\v1\controllers;

use common\models\CityRest;
use yii\rest\ActiveController;

/**
 * Cities REST controller.
 */
class CitiesController extends ActiveController
{
    use RestControllerBehaviorsTrait;

    /** {@inheritDoc} */
    public $modelClass = CityRest::class;
}