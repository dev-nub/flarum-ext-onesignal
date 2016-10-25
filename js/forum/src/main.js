import { extend } from 'flarum/extend';
import app from 'flarum/app';

app.initializers.add('zurtr-onesignal', () =>  {
    console.log(app);
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
        if(subDomain && subDomain.length > 0)
            initObj.subdomainName = subDomain;

    OneSignal.push(["init", initObj]);

    OneSignal.push(function() {
        /* These examples are all valid */
        OneSignal.getUserId(function(userId) {
            console.log("OneSignal User ID:", userId);
            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
        });

        OneSignal.getUserId().then(function(userId) {
            console.log("OneSignal User ID:", userId);
            // (Output) OneSignal User ID: 270a35cd-4dda-4b3f-b04e-41d7463a2316
        });
    });
});