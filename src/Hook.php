<?php

namespace Acms\Plugins\ApiPreview;

use App;
use Acms\Plugins\ApiPreview\Services\Config\Helper;

class Hook
{
    /**
     * @var Helper
     */
    protected $Config;

    /**
     * constructor
     *
     */
    public function __construct()
    {
        $this->Config = App::make('api-preview.service.config');
    }
    /**
     * 例: グローバル変数の拡張
     *
     * @param object &$globalVars
     */
    public function extendsGlobalVars(&$globalVars)
    {
        $data = [
            'API_PREVIEW_KEY' => $this->Config->get('api_preview_preview_key', ''),
        ];


        foreach ($data as $key => $value) {
            $globalVars->setField($key, $value);
        }
    }
}
