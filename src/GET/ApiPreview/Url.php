<?php

namespace Acms\Plugins\ApiPreview\GET\ApiPreview;

use App;
use ACMS_GET;
use Template;
use ACMS_Corrector;

class Url extends ACMS_GET
{
    public function get()
    {
        $tpl = new Template($this->tpl, new ACMS_Corrector());
        $config = App::make('api-preview.service.config');
        $previewService = App::make('api-preview.service.preview');

        if ($previewService->isEnable() === false) {
            return '';
        }

        return $tpl->render([
            'previewUrl' => setGlobalVars($config->get('api_preview_preview_url', '')),
        ]);
    }
}
