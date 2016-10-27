<?php

namespace Zurtr\OneSignal\Listener;

use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Event\ConfigureClientView;

class AddHeadData {
	protected $settings;
	public function __construct(SettingsRepositoryInterface $settings) {
		$this->settings = $settings;
	}
	public function subscribe(Dispatcher $events) {
		$events->listen ( ConfigureClientView::class, [ 
				$this,
				'getClientView' 
		] );
	}
	public function getClientView(ConfigureClientView $event) {
		if ($event->isForum ()) {
			$event->view->addHeadString ( '<link rel="manifest" href="/manifest.json">' );
		}
	}
}