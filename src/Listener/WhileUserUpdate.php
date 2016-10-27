<?php

namespace Zurtr\OneSignal\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Event\UserWillBeSaved;

class WhileUserUpdate {
	public function subscribe(Dispatcher $events) {
		$events->listen ( UserWillBeSaved::class, [ 
				$this,
				'updateOneSignalId' 
		] );
	}
	public function updateOneSignalId(UserWillBeSaved $event) {
		$attributes = array_get ( $event->data, 'attributes', [ ] );
		if (array_key_exists ( 'one_signal_user_id', $attributes )) {
			$user = $event->user;
			$actor = $event->actor;
			if ($actor->id !== $user->id) {
				$this->assertPermission ( $this->elementsOnlyRemoved ( $user->one_signal_user_id, $attributes ['one_signal_user_id'] ) );
				$this->assertCan ( $actor, 'edit', $user );
			}
			$user->one_signal_user_id = $attributes ['one_signal_user_id'];
        }

    }
}