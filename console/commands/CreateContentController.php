<?php

namespace console\commands;

use common\models\City;
use common\models\Country;
use common\models\Region;
use common\models\User;
use yii\console\Controller;
use yii\db\ActiveRecord;

/**
 * Command creates content for service.
 */
class CreateContentController extends Controller
{
    /**
     * @var array Users data
     */
    protected $users = [
        ['username' => 'admin', 'password' => 'admin'],
    ];

    /**
     * @var array Cities data
     */
    protected $citiesData = [
        'Россия' => [
            'Самарская область' => ['Тольятти', 'Самара', 'Сызрань', 'Залетный'],
            'Московская область' => ['Москва', 'Залетный'],
        ],
        'Белоруссия' => [
            'Брестская область' => ['Брест']
        ],
    ];

    /**
     * Runs content create process.
     */
    public function actionIndex()
    {
        foreach ($this->users as $user) {
            $this->saveModelOnErrorExit(new User($user));
        }

        foreach ($this->citiesData as $country => $regions) {
            $countryModel = $this->saveModelOnErrorExit(
                new Country([
                    'name' => $country
                ])
            );

            foreach ($regions as $region => $cities) {
                $regionModel = $this->saveModelOnErrorExit(
                    new Region([
                        'name' => $region,
                        'country_id' => $countryModel->id
                    ])
                );

                foreach ($cities as $city) {
                    $this->saveModelOnErrorExit(
                        new City([
                            'name' => $city,
                            'region_id' => $regionModel->id
                        ])
                    );
                }
            }
        }
    }

    /**
     * Saves model and returns it. If save fails - prints error messages and exits.
     *
     * @param ActiveRecord $model
     * @return ActiveRecord
     */
    protected function saveModelOnErrorExit(ActiveRecord $model)
    {
        if ($model->save() === false) {
            $this->stdout(sprintf(
                'Errors occured while saving model %s: %s', get_class($model), print_r($model->getErrors(), true)
            ));
            exit(Controller::EXIT_CODE_ERROR);
        }

        return $model;
    }
}