<?php

declare(strict_types=1);

namespace Acms\Plugins\ApiPreview\Services\Preview;

use App;
use Acms\Plugins\ApiPreview\Domain\ValueObjects\Previewkey;
use Acms\Plugins\ApiPreview\Services\Config\Helper;

class PreviewService
{
    /**
     * @var Helper
     */
    protected Helper $config;

    protected Previewkey $previewKey;

    public function __construct()
    {
        $this->config = App::make('api-preview.service.config');
        $this->previewKey = new Previewkey($this->config->get('api_preview_preview_key', ''));
    }

    public function verifyPreviewKey(Previewkey $previewkey): bool
    {
        return $this->previewKey->equals($previewkey);
    }

    public function isEnable()
    {
        return $this->config->get('api_preview_enable', 'off') === 'on';
    }

    public function enablePreviewMode()
    {
        if (defined('ACMS_SID') === false) {
            define('ACMS_SID', 1);
        }
        if (defined('SUID') === false) {
            define('SUID', 1);
        }
        if (defined('SBID') === false) {
            define('SBID', 1);
        }
        if (defined('IS_PREVIEW') === false) {
            define('IS_PREVIEW', 1);
        }
    }
}
