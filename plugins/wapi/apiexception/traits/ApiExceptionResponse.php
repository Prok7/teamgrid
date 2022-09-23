<?php namespace WApi\ApiException\Traits;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use WApi\ApiException\Classes\Handlers\AuthExceptionHandler;
use WApi\ApiException\Classes\Handlers\ExceptionHandler;
use WApi\ApiException\Classes\Handlers\ModelNotFoundExceptionHandler;
use WApi\ApiException\Classes\Handlers\NotFoundHttpExceptionHandler;
use WApi\ApiException\Classes\Handlers\UnauthorizedHttpExceptionHandler;
use WApi\ApiException\Classes\Handlers\ValidationExceptionHandler;

trait ApiExceptionResponse
{
    protected $exceptionHandlers = [
        ModelNotFoundExceptionHandler::class,
        NotFoundHttpExceptionHandler::class,
        UnauthorizedHttpExceptionHandler::class,
        ValidationExceptionHandler::class,
        AuthExceptionHandler::class,

        ExceptionHandler::class
    ];

    public function apiExceptionResponse($exception)
    {
        $exceptionHandlerClass = collect($this->exceptionHandlers)->filter(function ($class) use ($exception) {
            return $class::isProcessable($exception);
        })->first();

        if (!$exceptionHandlerClass) {
            return;
        }

        $exceptionHandler = new $exceptionHandlerClass($exception);
        $responseContent = $exceptionHandler->getResponseContent();
        $responseStatusCode = $exceptionHandler->getStatusCode();

        $response = Event::fire('wapi.apiexception.response', [$exceptionHandler], true);
        if ($response) {
            if ($response instanceof Response) {
                return $response;
            }

            $responseContent = $response;
        }

        return new Response($responseContent, $responseStatusCode);

//        Event::fire('exception.report', [$exception]);
    }
}
