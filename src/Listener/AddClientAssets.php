<?php
namespace Zurtr\OneSignal\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;


use Flarum\Event\ConfigureClientView;


class AddClientAssets
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addAssets']);

/*        $events->listen(ConfigureClientView::class, function (ConfigureClientView $event) {
            if ($event->isForum()) {
                $event->addAssets(__DIR__.'/js/forum/dist/extension.js');
                $event->addBootstrapper('zurtr/onesignal/main');
            }
        });*/
    }

    /**
     * @param ConfigureWebApp $event
     */
    public function addAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets(['https://cdn.onesignal.com/sdks/OneSignalSDK.js']);
            $event->addAssets([
                __DIR__.'/../../js/forum/dist/extension.js'
            ]);
            $event->addBootstrapper('zurtr/onesignal/main');
        }
        if ($event->isAdmin()) {
            $event->addAssets([
                __DIR__.'/../../js/admin/dist/extension.js'
            ]);
            $event->addBootstrapper('zurtr/onesignal/main');
        }
    }
}
