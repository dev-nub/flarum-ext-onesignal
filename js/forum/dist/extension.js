'use strict';

System.register('zurtr/onesignal/main', ['flarum/extend', 'flarum/app', 'flarum/Model', 'flarum/models/User'], function (_export, _context) {
    "use strict";

    var extend, app, Model, User;
    return {
        setters: [function (_flarumExtend) {
            extend = _flarumExtend.extend;
        }, function (_flarumApp) {
            app = _flarumApp.default;
        }, function (_flarumModel) {
            Model = _flarumModel.default;
        }, function (_flarumModelsUser) {
            User = _flarumModelsUser.default;
        }],
        execute: function () {
            app.initializers.add('zurtr-onesignal', function () {
                User.prototype.one_signal_user_id = Model.attribute('one_signal_user_id');
                $(document).ready(function () {
                    var appId = app.forum.attribute('zurtr_onesignal_app_id'),
                        subDomain = app.forum.attribute('zurtr_onesignal_subdomain'),
                        OneSignal = window.OneSignal || [],
                        initObj = {
                        appId: appId,
                        autoRegister: false,
                        notifyButton: {
                            enable: true /* Set to false to hide */
                        }
                    };
                    if (subDomain && subDomain.length > 0) initObj.subdomainName = subDomain;

                    OneSignal.push(["init", initObj]);
                    OneSignal.push(function () {
                        OneSignal.on('subscriptionChange', function (isSubscribed) {
                            if (isSubscribed) {
                                // The user is subscribed
                                //   Either the user subscribed for the first time
                                //   Or the user was subscribed -> unsubscribed -> subscribed
                                //var flarumUserId = app.session.user.id(); dont rely on this
                                OneSignal.getUserId(function (userId) {
                                    // Make a POST call to your server with the user ID
                                    console.log('userId', userId);
                                    var user = app.session.user;
                                    user.save({ one_signal_user_id: userId });
                                });
                            }
                        });
                    });
                });
            });
        }
    };
});