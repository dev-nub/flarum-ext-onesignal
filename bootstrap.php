<?php

/**
 * @author Vivex <contact@viveksoni.net>
 */
use Flarum\OneSignal\Listener;

use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
  $events->subscribe(Listener\AddClientAssets::class);
  $events->subscribe(Listener\FilterNewPosts::class);
};