<?php

namespace Zurtr\OneSignal\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;

class AddClientAssets {
	public function subscribe(Dispatcher $events) {
		$events->listen ( ConfigureWebApp::class, [ 
				$this,
				'addAssets' 
		] );
	}
	public function addAssets(ConfigureWebApp $event) {
		if ($event->isForum ()) {
			$event->addAssets ( [ 
					'https://cdn.onesignal.com/sdks/OneSignalSDK.js' 
			] );
			$event->addAssets ( [ 
					__DIR__ . '/../../js/forum/dist/extension.js' 
			] );
			$event->addBootstrapper ( 'zurtr/onesignal/main' );
		}
		if ($event->isAdmin ()) {
			$event->addAssets ( [ 
					__DIR__ . '/../../js/admin/dist/extension.js' 
			] );
			$event->addBootstrapper ( 'zurtr/onesignal/main' );
		}
	}
}
