<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository;

class Handler implements HandlerInterface
{

    use \Neighborhoods\Kojo\Notifier\Map\Repository\AwareTrait, \Neighborhoods\Kojo\Psr\Http\Message\ServerRequest\AwareTrait, \Neighborhoods\Kojo\Where\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);

        return new \Zend\Diactoros\Response\JsonResponse($this->get());
    }

    protected function get() : \Neighborhoods\Kojo\Notifier\MapInterface
    {
        $whereBuilder = $this->getWhereServerRequestBuilderFactory()->create();
        $whereBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $where = $whereBuilder->build();

        return $this->getAskNotifierMapRepository()->get($where);
    }

    protected function getRouteResult() : \Zend\Expressive\Router\RouteResult
    {
        return $this->getPsrHttpMessageServerRequest()->getAttribute(\Zend\Expressive\Router\RouteResult::class);
    }


}

