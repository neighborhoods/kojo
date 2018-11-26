<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository;

class Handler implements HandlerInterface
{

    use \Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository\AwareTrait, \Neighborhoods\Kojo\Psr\Http\Message\ServerRequest\AwareTrait, \Neighborhoods\Kojo\SearchCriteria\ServerRequest\Builder\Factory\AwareTrait;

    public function handle(\Psr\Http\Message\ServerRequestInterface $request) : \Psr\Http\Message\ResponseInterface
    {
        $this->setPsrHttpMessageServerRequest($request);

        return new \Zend\Diactoros\Response\JsonResponse($this->get());
    }

    protected function get() : \Neighborhoods\Kojo\SearchCriteria\Filter\GroupInterface
    {
        $searchCriteriaBuilder = $this->getSearchCriteriaServerRequestBuilderFactory()->create();
        $searchCriteriaBuilder->setPsrHttpMessageServerRequest($this->getPsrHttpMessageServerRequest());
        $searchCriteria = $searchCriteriaBuilder->build();

        return $this->getSearchCriteriaFilterGroupRepository()->get($searchCriteria);
    }

    protected function getRouteResult() : \Zend\Expressive\Router\RouteResult
    {
        return $this->getPsrHttpMessageServerRequest()->getAttribute(\Zend\Expressive\Router\RouteResult::class);
    }


}

