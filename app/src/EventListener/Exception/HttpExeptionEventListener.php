<?php

namespace App\EventListener\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class HttpExeptionEventListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $request   = $event->getRequest();
        $exception = $event->getThrowable();
        
        if (strpos($request->getPathInfo(), '/api/') === 0) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }
    
    /**
     * Creates the ApiResponse from any Exception
     *
     * @param \Exception $exception
     *
     */
    private function createApiResponse(\Exception $exception)
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR;
       
        

        $ret['errors'][] = [
            "status" => $statusCode,
            "title" => "Error found",
            "detail" => $exception->getMessage()
        ];

        $response = new Response();
        $response->setContent(json_encode($ret));

        return $response;
    }
}