<?php

namespace App\Http\Controllers;

use App\Http\Response\Schemas\Api\User\AuthSchema;
use App\Http\Validators\AnalyticsValidation;
use Bschmitt\Amqp\Facades\Amqp;
use Carbon\Carbon;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class AnalyticsController
 * @package App\Http\Controllers
 */
class AnalyticsController extends BaseController
{
    protected $validationRules;

    /**
     * AnalyticsController constructor.
     */
    public function __construct()
    {
        $this->validationRules = new AnalyticsValidation();
    }

    /**
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function trackAction(Request $request)
    {
        $userValidatedData = $this->validate($request, $this->validationRules->getPageTrackRules());
        $sourcePoint = Arr::get($userValidatedData, 'source_point');

        //todo:: use event manager, and do not fire message from controller
        Amqp::publish('', json_encode([
            'id'           => rand(),
            'id_user'      => (Auth::guard('optional_auth'))->id(),
            'source_label' => $sourcePoint,
            'date_created' => Carbon::now()
        ]), ['queue' => env('RABBITMQ_QUEUE')]);
    }
}
