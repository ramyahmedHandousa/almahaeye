$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
 var config = {
     apiKey: "AIzaSyA03J4tz9Vo7bx8U8SPSLrrB--Jgq3nqVw",
     authDomain: "water-b8bc2.firebaseapp.com",
     projectId: "water-b8bc2",
     storageBucket: "water-b8bc2.appspot.com",
     messagingSenderId: "612633937048",
     appId: "1:612633937048:web:c1f44776512ac9901efced",
     measurementId: "G-CP6RZQGRGT"
 };
  firebase.initializeApp(config);

const messaging = firebase.messaging();


messaging.usePublicVapidKey("BD4svodC3CcHxYzHQaLF4y-j2IR3ivoW4Qf92fr1m7YKtByMKI3TPph3KH4_3IXxarvhgtM21pEIKrSwdzacXBU");




messaging.requestPermission().then(function () {

    navigator.serviceWorker.register('/assets/fcm/firebase-v1-messaging-sw.js')
        .then((registration) => {
            messaging.useServiceWorker(registration);
            // Request permission and get token.....
            getToken();
        })
    // console.log('Notification permission granted.');


}).catch(function (err) {

    // console.log('Unable to get permission to notify.', err);

});

function getToken() {

    messaging.onTokenRefresh(function () {
        messaging.getToken().then(function (refreshedToken) {
            console.log(refreshedToken);
            Listen();
        }).catch(function (err) {
            console.log('Unable to retrieve refreshed token ', err);
        });
    });

    messaging.getToken().then(function (currentToken) {

        if (currentToken) {
            console.log(currentToken);
            if (userId) {
                $.ajax({
                    type: "POST", url: url, data: {id: userId, token: currentToken}, success: function (data) {
                    }
                });
            }

            Listen();

        } else {

            console.log('No Instance ID token available. Request permission to generate one.');
        }

    }).catch(function (err) {

        console.log('An error occurred while retrieving token. Ramy ', err);

    });


}



function Listen() {

    messaging.onMessage(function (payload) {

         var n = new Notification(payload.notification.title, {
			body: payload.notification.body,
			icon: payload.notification.icon, // optional
			onclick: payload.notification.click_action
		});

        console.log(payload)

        n.onclick = function(event) {
                event.preventDefault(); // prevent the browser from focusing the Notification's tab
              window.open(payload.notification.click_action, '_blank');
            }
    });
}
