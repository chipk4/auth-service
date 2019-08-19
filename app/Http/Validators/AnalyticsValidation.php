<?php

namespace App\Http\Validators;

/**
 * Class AnalyticsValidation
 * @package App\Http\Validators
 */
class AnalyticsValidation
{
    /**
     * @param array $additionalRules
     * @return array
     */
    public function getPageTrackRules(array $additionalRules = [])
    {
        return array_merge($additionalRules, [
            'source_point' => 'required|string',
            'api_key'      => 'string'
        ]);
    }
}
