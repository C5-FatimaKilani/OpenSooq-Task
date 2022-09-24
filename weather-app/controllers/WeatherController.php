<?php


namespace app\controllers;

use app\models\User;
use app\services\weather\WeatherService;
use Yii;
use yii\base\Exception;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;

class WeatherController extends \yii\rest\Controller
{
    private $weather_service;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->weather_service = new WeatherService();
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' =>
                [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        $params = \Yii::$app->request->queryParams;
        if (!empty($params) && isset($params['city']) && !empty($params['city'])) {
            $city = $params['city'];
            try {
                $result = $this->weather_service->getCityWeather($city);
                if ($result) {
                    return $result;
                }
            } catch (Exception $ex) {
                throw new \yii\web\HttpException(500, 'Internal server error');
            }
            throw new \yii\web\HttpException(500, 'Something went wrong! Please try again later.');
        } else {
            throw new \yii\web\HttpException(400, 'city is missing');
        }
    }
}
