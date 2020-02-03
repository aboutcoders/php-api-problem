<?php

namespace Abc\ApiProblem;

use Throwable;

class InvalidJsonException extends \InvalidArgumentException
{
    /**
     * @var string
     */
    private $json;

    public function __construct($json, $previous = null)
    {
        parent::__construct('Invalid JSON', 400, $previous);

        $this->json = $json;
    }

    public function getJson(): string
    {
        return $this->json;
    }
}
