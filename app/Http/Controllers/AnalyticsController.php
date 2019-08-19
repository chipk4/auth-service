<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class AnalyticsController
 * @package App\Http\Controllers
 */
class AnalyticsController extends BaseController
{
    public function trackAction(Request $request)
    {
        var_dump($request->session()->getId());
//        app('redis')->set('test', 'qqq');
//        TrackUserBehaviorJob::dispatch()->onQueue('tracking_service');
//        dispatch(new TrackUserBehaviorJob())->onQueue('tracking_service');
    }
}
