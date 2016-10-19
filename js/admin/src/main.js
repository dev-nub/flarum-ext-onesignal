import app from 'flarum/app';

import OneSignalSettingsModal from 'zurtr/onesignal/components/OneSignalSettingsModal';

app.initializers.add('zurtr-onesignal', () => {
    app.extensionSettings['zurtr-onesignal']  = () =>  app.modal.show(new OneSignalSettingsModal());
});