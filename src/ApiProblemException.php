<?php

namespace Abc\ApiProblem;

class ApiProblemException extends \Exception
{
    private $apiProblem;

    public function __construct(ApiProblem $apiProblem)
    {
        parent::__construct($apiProblem->getDetail(), $apiProblem->getStatus());

        $this->apiProblem = $apiProblem;
    }

    public function getApiProblem(): ApiProblem
    {
        return $this->apiProblem;
    }
}
