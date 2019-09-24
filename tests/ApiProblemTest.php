<?php

namespace Abc\ApiProblem\Tests;

use Abc\ApiProblem\ApiProblem;
use Abc\ApiProblem\InvalidParameter;
use PHPUnit\Framework\TestCase;

class ApiProblemTest extends TestCase
{
    public function testSerialize()
    {
        $invalidParameter = new InvalidParameter('myName', 'myReason', 'myValue');
        $apiProblem = new ApiProblem('myType', 'myTitle', 200, 'myDetail', 'myInstance');
        $apiProblem->setInvalidParams([$invalidParameter]);

        $json = $apiProblem->toJson();

        $object = json_decode($json);
        $array = json_decode($json, true);

        $this->assertEquals($apiProblem->getType(), $object->type);
        $this->assertEquals($apiProblem->getTitle(), $object->title);
        $this->assertEquals($apiProblem->getStatus(), $object->status);
        $this->assertEquals($apiProblem->getDetail(), $object->detail);
        $this->assertEquals($apiProblem->getInstance(), $object->instance);

        $this->assertEquals($apiProblem->getInvalidParams()[0]->getName(), $array['invalid-params'][0]['name']);
        $this->assertEquals($apiProblem->getInvalidParams()[0]->getReason(), $array['invalid-params'][0]['reason']);
        $this->assertEquals($apiProblem->getInvalidParams()[0]->getValue(), $array['invalid-params'][0]['value']);
    }

    public function testDeserialize()
    {
        $invalidParameter = new InvalidParameter('myName', 'myReason', 'myValue');
        $apiProblem = new ApiProblem('myType', 'myTitle', 200, 'myDetail', 'myInstance');
        $apiProblem->setInvalidParams([$invalidParameter]);

        $decodedApiProblem = ApiProblem::fromJson($apiProblem->toJson());

        $this->assertEquals($apiProblem, $decodedApiProblem);
    }
}
