<?php

declare(strict_types=1);

namespace Acms\Plugins\ApiPreview\Services\Config;

use Field;
use Acms\Services\Facades\Config;

/**
 * 拡張アプリのコンフィグ
 */
class Helper
{
    /**
     * @var \Field
     */
    protected $Config;

    public function __construct()
    {
        $this->Config = Config::loadDefaultField();
        $this->Config->overload(Config::loadBlogConfig(BID));
    }

    public function get(string $key, mixed $default = null, int $i = 0)
    {
        return $this->Config->get($key, $default, $i);
    }

    public function getArray(string $key, bool $strict = false): array
    {
        return $this->Config->getArray($key, $strict);
    }

    public function set(string $key, mixed $val = null)
    {
        $this->Config->setField($key, $val);
    }
}
