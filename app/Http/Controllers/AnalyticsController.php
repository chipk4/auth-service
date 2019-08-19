<?php

namespace App\Http\Controllers;

use Bschmitt\Amqp\Facades\Amqp;
use Carbon\Carbon;
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
        Amqp::publish('', json_encode([
            'id' => rand(),
            'id_user' => '1',
            'source_label' => 'source_test',
            'date_created' => Carbon::now()
            ]), ['queue' => 'tracking_service']);
    }
}
