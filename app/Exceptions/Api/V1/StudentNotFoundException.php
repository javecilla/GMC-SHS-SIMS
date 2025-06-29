<?php

namespace App\Exceptions\Api\V1;

use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\Api\BaseApiException;

class StudentNotFoundException extends BaseApiException
{
    protected int $status = Response::HTTP_NOT_FOUND;

    protected function defaultMessage(): string
    {
        return "Student is not found.";
    }
}
