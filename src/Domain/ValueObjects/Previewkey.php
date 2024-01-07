<?php

declare(strict_types=1);

namespace Acms\Plugins\ApiPreview\Domain\ValueObjects;

class Previewkey
{
    /**
     * @var string
     */
    protected string $previewKey;

    /**
     * @param string $previewKey
     */
    public function __construct(string $previewKey)
    {
        $this->previewKey = $previewKey;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->previewKey;
    }

    public function equals(mixed $value): bool
    {
        if ($value instanceof Previewkey) {
            return $this->previewKey === (string)$value;
        }
        return $this->previewKey === $value;
    }
}
