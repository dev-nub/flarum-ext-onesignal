<?php

namespace Zurtr\OneSignal;

use Flarum\Forum\Controller\WebAppController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Flarum\Settings\SettingsRepositoryInterface;

class OneSignalManifestController extends WebAppController {
	protected $settings;
	public function __construct(SettingsRepositoryInterface $settings) {
		$this->settings = $settings;
	}
	public function render(Request $request) {
		$appName = $this->settings->get ( 'forum_title' );
		echo <<<END
            {
              "name": "$appName",
              "short_name": "$appName",
              "start_url": "/",
              "display": "standalone",
              "gcm_sender_id": "482941778795"
            }
END;
    }
}