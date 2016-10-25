<?php

namespace Zurtr\OneSignal\Listener;

use Flarum\Event\PrepareApiAttributes;
use Flarum\Settings\SettingsRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;

class AddOneSignalAttribute
{

    protected $settings;


    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }


    public function subscribe(Dispatcher $events)
    {
        $events->listen(AddOneSignalAttribute::class, [$this, 'addAttributes']);
    }

    public function addAttributes(PrepareApiAttributes $event)
    {

        $event->attributes['zurtr_onesignal_app_id'] = $this->settings->get('zurtr-onesignal.one_signal_app_id');
        $event->attributes['zurtr_onesignal_subdomain'] = $this->settings->get('zurtr-onesignal.onesignal_subdomain');
    }
}