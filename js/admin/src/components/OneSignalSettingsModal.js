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
            </div>,
            <div className="form-group">
                <label>API Key: </label>
                <input className="FormControl" bidi={this.setting('zurtr-onesignal.one_signal_api_key')}/>
            </div>,
            <div className="form-group">
                <label>Subdomain (Leave blank if website is <b>https</b>): </label>
                <input className="FormControl" bidi={this.setting('zurtr-onesignal.onesignal_subdomain')}/>
            </div>
    ];
    }
}