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

    protected \Field $getParameter;

    protected \Field $queryParameter;

    public function __construct()
    {
        $this->getParameter = App::getGetParameter();
        $this->queryParameter = App::getQueryParameter();
        $this->config = App::make('api-preview.service.config');
        $this->previewKey = new Previewkey($this->config->get('api_preview_preview_key', ''));
    }

    public function processPreview()
    {
        if ($this->shouldVerifyPreviewKey() === false) {
            return;
        }

        $previewKey = new Previewkey($this->getParameter->get('previewKey', ''));

        if ($this->verifyPreviewKey($previewKey) === true) {
            $this->enablePreviewMode();
        }
    }

    protected function shouldVerifyPreviewKey(): bool
    {
        if (config('api_enable') !== 'on') {
            return false;
        }

        if (empty($this->queryParameter->get('api'))) {
            return false;
        }

        if ($this->isEnable() === false) {
            return false;
        }

        if ($this->getParameter->isExists('previewKey') === false) {
            return false;
        }

        return true;
    }

    protected function verifyPreviewKey(Previewkey $previewkey): bool
    {
        return $this->previewKey->equals($previewkey);
    }

    public function isEnable()
    {
        return $this->config->get('api_preview_enable', 'off') === 'on';
    }

    protected function enablePreviewMode()
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
