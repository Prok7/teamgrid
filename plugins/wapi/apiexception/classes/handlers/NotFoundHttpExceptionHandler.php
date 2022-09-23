<?php namespace WApi\ApiException\Classes\Handlers;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpExceptionHandler extends BaseExceptionHandler
{
    protected static $processableExceptions = [
        NotFoundHttpException::class
    ];

    public function getMessage()
    {
        return 'page not found';
    }

    public function getStatusCode()
    {
        return 404;
    }
}