 $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
var config = {
    apiKey: "AIzaSyC0f8dd1dtf1h-wVxJjtiIk3dq2teCzWf0",
    authDomain: "reservaapp-599f0.firebaseapp.com",
    databaseURL: "https://reservaapp-599f0.firebaseio.com",
    projectId: "reservaapp-599f0",
    storageBucket: "",
    messagingSenderId: "865603333137",
    // appId: "1:865603333137:web:db1764a4afcc82a7ee95b0",
    // measurementId: "G-6J59S9T52C"
};
firebase.initializeApp(config);
const messaging = firebase.messaging();
messaging.usePublicVapidKey("BO5jJKFCUKN8Rx_NeDgZvEJDORISsMSD0Aub0CosZEQWyZg6RyDDVb-iGWtkb8vRHYiihBF4rZkAVr-8-4rPjc8");
messaging.requestPermission().then(function () {
    console.log('Notification permission granted.');
    getToken();
}).catch(function (err) {
    console.log('Unable to get permission to notify.', err);
});

function getToken() {
    messaging.onTokenRefresh(function () {
        messaging.getToken().then(function (refreshedToken) {
            console.log(refreshedToken);
            Listen();
        }).catch(function (err) {
            console.log('Unable to retrieve refreshed token ', err);
            showToken('Unable to retrieve refreshed token ', err);
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
        console.log('An error occurred while retrieving token. ', err);
    });

}

function Listen() {
    messaging.onMessage(function (payload) {
        console.log(payload);

        const notificationTitle = payload.data.message;
        const notificationOptions = {
            body:  payload.data.description,
            icon: '/firebase-logo.png'
        };

        return self.registration.showNotification(notificationTitle,notificationOptions);

    });
}