<?php

namespace App\Exceptions\Api;

use Exception;

/**
 * Class ApiMonitoringException
 *
 * This exception is intended for low-priority or non-critical issues
 * that should be monitored or sampled occasionally.
 *
 * Use this when you want to:
 * - Track unexpected but non-breaking behavior
 * - Log anomalies or edge cases for analysis
 * - Avoid spamming your error reporting tools (e.g. Sentry)
 *
 * This exception is throttled using the `Exception::throttle()` mechanism
 * to control how often it’s reported, improving performance and reducing noise.
 *
 * @example
 * throw new ApiMonitoringException("Unexpected payload structure received.");
 */
class ApiMonitoringException extends Exception
{
    /*
       #Sample use case:
        if (!isset($payload['expected_key'])) {
            # Log this for later analysis, but don’t break the app
            throw new ApiMonitoringException("Missing 'expected_key' in API payload.");
        }
     */
}
