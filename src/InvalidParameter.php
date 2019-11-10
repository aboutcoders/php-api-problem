<?php

namespace Abc\ApiProblem;

use OpenApi\Annotations as OA;

/**
 * Provides information about an invalid parameter provided as part of an HTTP API request.
 *
 * @see https://tools.ietf.org/html/rfc7807
 */
class InvalidParameter
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var string|null
     */
    private $value;

    public function __construct(string $name = null, string $reason = null, string $value = null)
    {
        $this->name = $name;
        $this->reason = $reason;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getValue():?string
    {
        return $this->value;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function set(string $key, string $value): void
    {
        $this->$key = $value;
    }

    public function get(string $key):?string
    {
        return isset($this->$key) ?: null;
    }

    public static function fromArray(array $data): self
    {
        return new InvalidParameter($data['name'], $data['reason'], $data['value'] ?? null);
    }
}
