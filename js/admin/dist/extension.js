'use strict';

System.register('zurtr/onesignal/components/OneSignalSettingsModal', ['flarum/components/SettingsModal'], function (_export, _context) {
    "use strict";

    var SettingsModal, OneSignalSettingsModal;
    return {
        setters: [function (_flarumComponentsSettingsModal) {
            SettingsModal = _flarumComponentsSettingsModal.default;
        }],
        execute: function () {
            OneSignalSettingsModal = function (_SettingsModal) {
                babelHelpers.inherits(OneSignalSettingsModal, _SettingsModal);

                function OneSignalSettingsModal() {
                    babelHelpers.classCallCheck(this, OneSignalSettingsModal);
                    return babelHelpers.possibleConstructorReturn(this, (OneSignalSettingsModal.__proto__ || Object.getPrototypeOf(OneSignalSettingsModal)).apply(this, arguments));
                }

                babelHelpers.createClass(OneSignalSettingsModal, [{
                    key: 'className',
                    value: function className() {
                        console.log('ClassNameCalled');
                        return 'OneSignalSettingsModal Modal--small';
                    }
                }, {
                    key: 'title',
                    value: function title() {
                        console.log('title called');
                        return 'OneSignal Settings';
                    }
                }, {
                    key: 'form',
                    value: function form() {
                        console.log('Form Called');
                        return [m(
                            'div',
                            { className: 'form-group' },
                            m(
                                'label',
                                null,
                                'OneSignal AppID: '
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('zurtr-onesignal.one_signal_app_id') })
                        ), m(
                            'div',
                            { className: 'form-group' },
                            m(
                                'label',
                                null,
                                'API Key: '
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('zurtr-onesignal.one_signal_api_key') })
                        ), m(
                            'div',
                            { className: 'form-group' },
                            m(
                                'label',
                                null,
                                'Subdomain (if not https): '
                            ),
                            m('input', { className: 'FormControl', bidi: this.setting('zurtr-onesignal.onesignal_subdomain') })
                        )];
                    }
                }]);
                return OneSignalSettingsModal;
            }(SettingsModal);

            _export('default', OneSignalSettingsModal);
        }
    };
});;
'use strict';

System.register('zurtr/onesignal/main', ['flarum/app', 'zurtr/onesignal/components/OneSignalSettingsModal'], function (_export, _context) {
    "use strict";

    var app, OneSignalSettingsModal;
    return {
        setters: [function (_flarumApp) {
            app = _flarumApp.default;
        }, function (_zurtrOnesignalComponentsOneSignalSettingsModal) {
            OneSignalSettingsModal = _zurtrOnesignalComponentsOneSignalSettingsModal.default;
        }],
        execute: function () {

            app.initializers.add('zurtr-onesignal', function () {
                app.extensionSettings['zurtr-onesignal'] = function () {
                    return app.modal.show(new OneSignalSettingsModal());
                };
            });
        }
    };
});