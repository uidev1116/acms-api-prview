<?php

declare(strict_types=1);

namespace Acms\Plugins\ApiPreview;

use ACMS_App;
use Acms\Services\Facades\Application as Container;
use Acms\Services\Common\InjectTemplate;
use Acms\Services\Common\HookFactory;

class ServiceProvider extends ACMS_App
{
    /**
     * @var string
     */
    public $version = '0.0.5';

    /**
     * @var string
     */
    public $name = 'ApiPreview';

    /**
     * @var string
     */
    public $author = 'uidev1116';

    /**
     * @var bool
     */
    public $module = false;

    /**
     * @var bool|string
     */
    public $menu = 'api_preview_index';

    /**
     * @var string
     */
    public $desc = 'a-blog cms をヘッドレスCMSとして利用する場合にプレビュー機能を実装するための拡張アプリです。';

    public function __construct()
    {
        /** @var \Acms\Services\Container */
        $container = Container::getInstance();

        /**
         * Register Service
         */
        $container->singleton(
            'api-preview.service.config',
            Services\Config\Helper::class
        );
        $container->singleton(
            'api-preview.service.preview',
            Services\Preview\PreviewService::class
        );
    }

    /**
     * サービスの初期処理
     */
    public function init()
    {
        /**
         * Attach Hook
         */
        $hook = HookFactory::singleton();
        $hook->attach('api-preview.hook', new Hook());

        /**
         * Inject Template
         */
        $inject = InjectTemplate::singleton();
        if (ADMIN === 'app_' . $this->menu) {
            $inject->add('admin-topicpath', PLUGIN_DIR . $this->name . '/template/admin/topicpath.html');
            $inject->add('admin-main', PLUGIN_DIR . $this->name . '/template/admin/main.html');
        }
        if (ADMIN === 'entry_editor') {
            $inject->add('admin-entry-editor-top', PLUGIN_DIR . $this->name . '/template/admin/entry/editor/top.html');
        }
    }

    /**
     * インストールする前の環境チェック処理
     *
     * @return bool
     */
    public function checkRequirements()
    {
        return true;
    }

    /**
     * インストールするときの処理
     * データベーステーブルの初期化など
     *
     * @return void
     */
    public function install()
    {
    }

    /**
     * アンインストールするときの処理
     * データベーステーブルの始末など
     *
     * @return void
     */
    public function uninstall()
    {
    }

    /**
     * アップデートするときの処理
     *
     * @return bool
     */
    public function update()
    {
        return true;
    }

    /**
     * 有効化するときの処理
     *
     * @return bool
     */
    public function activate()
    {
        return true;
    }

    /**
     * 無効化するときの処理
     *
     * @return bool
     */
    public function deactivate()
    {
        return true;
    }
}
