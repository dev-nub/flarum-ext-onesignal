<?php

/**
 * @author Vivex <contact@viveksoni.net>
 */
namespace Zurtr\OneSignal;



use Illuminate\Contracts\Events\Dispatcher;
use Zurtr\OneSignal\Listener\AddClientAssets;
use Zurtr\OneSignal\Listener\AddHeadData;
use Zurtr\OneSignal\Listener\AddManifestRoute;
use Zurtr\OneSignal\Listener\AddOneSignalAttribute;
use Zurtr\OneSignal\Listener\NotificationWillBeSentListener;
use Zurtr\OneSignal\Listener\WhileUserUpdate;

return function (Dispatcher $events) {
    $events->subscribe(AddClientAssets::class);
    //$events->subscribe(NotificationWillBeSentListener::class);
    $events->subscribe(AddManifestRoute::class);
    $events->subscribe(AddHeadData::class);
    $events->subscribe(AddOneSignalAttribute::class);
    $events->subscribe(WhileUserUpdate::class);
};