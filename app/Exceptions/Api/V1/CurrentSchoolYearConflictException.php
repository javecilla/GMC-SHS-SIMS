<?php

namespace App\Exceptions\Api\V1;

use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\Api\BaseApiException;

class CurrentSchoolYearConflictException extends BaseApiException
{
    protected int $status = Response::HTTP_UNPROCESSABLE_ENTITY;

    protected function defaultMessage(): string
    {
        return "Another school year is already marked as current.";
    }
}
