import SettingsModal from 'flarum/components/SettingsModal';

export default class OneSignalSettingsModal extends SettingsModal {
    className() {
        console.log('ClassNameCalled');
        return 'OneSignalSettingsModal Modal--small';
    }

    title() {
        console.log('title called');
        return 'OneSignal Settings';
    }

    form() {
        console.log('Form Called');
        return [
            <div className="form-group">
                <label>OneSignal AppID: </label>
                <input className="FormControl" bidi={this.setting('zurtr-onesignal.one_signal_app_id')}/>
            </div>
    ];
    }
}