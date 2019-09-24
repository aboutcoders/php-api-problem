<?php

namespace Abc\ApiProblem;

use OpenApi\Annotations as OA;

/**
 * Problem details for an HTTP API according to RFC 7807
 *
 * @see https://tools.ietf.org/html/rfc7807
 *
 * @OA\Schema()
 */
class ApiProblem
{
    /**
     * @OA\Property()
     *
     * @var string
     */
    private $type;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property()
     *
     * @var int
     */
    private $status;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private $detail;

    /**
     * @OA\Property()
     *
     * @var string
     */
    private $instance;

    /**
     * @OA\Property(type="array",
     *     @OA\Items(ref="#/components/schemas/ApiProblem")
     * )
     * @var InvalidParameter[]
     */
    private $invalidParams;

    /**
     * Creates Problem Details for HTTP APIs according to RFC 7807
     *
     * @param string $type A URI reference [RFC3986] that identifies the problem type
     * @param string $title A short, human-readable summary of the problem type
     * @param int $status The HTTP status code
     * @param string|null $detail A human-readable explanation specific to this occurrence of the problem
     * @param string|null $instance A URI reference that identifies the specific occurrence of the problem
     */
    public function __construct(
        string $type,
        string $title,
        int $status,
        string $detail = null,
        string $instance = null
    ) {
        $this->type = $type;
        $this->title = $title;
        $this->status = $status;
        $this->detail = $detail;
        $this->instance = $instance;
        $this->invalidParams = [];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @return string
     */
    public function getInstance(): string
    {
        return $this->instance;
    }

    /**
     * @return InvalidParameter[]
     */
    public function getInvalidParams(): array
    {
        return $this->invalidParams;
    }

    /**
     * @param InvalidParameter[] $invalidParams
     */
    public function setInvalidParams(array $invalidParams)
    {
        $this->invalidParams = $invalidParams;
    }

    public function toArray(): array
    {
        $array = [
            'type' => $this->getType(),
            'title' => $this->getTitle(),
            'status' => $this->getStatus(),
            'detail' => $this->getDetail(),
            'instance' => $this->getInstance(),
            'invalid-params' => array_map(function (InvalidParameter $invalidParameter) {
                return $invalidParameter->toArray();
            }, $this->getInvalidParams()),
        ];

        foreach (['instance', 'invalid-params'] as $key) {
            if (null == $array[$key] || empty($array[$key])) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    public static function fromArray(array $data): self
    {
        $apiProblem = new static($data['type'], $data['title'], $data['status'], $data['detail'] ?? null, $data['instance'] ?? null);
        if(isset($data['invalid-params']))
        {
            $invalidParams = [];
            foreach ($data['invalid-params'] as $paramData) {
                $invalidParams[] = InvalidParameter::fromArray($paramData);
            }
            $apiProblem->setInvalidParams($invalidParams);
        }

        return $apiProblem;
    }

    public function toJson(): string
    {
        return json_encode((object) $this->toArray());
    }

    public static function fromJson(string $data): self
    {
        return static::fromArray(json_decode($data, true));
    }
}
