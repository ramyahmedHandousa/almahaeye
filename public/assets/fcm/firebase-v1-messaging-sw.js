importScripts('https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js');

importScripts('https://www.gstatic.com/firebasejs/8.2.1/firebase-messaging.js');


firebase.initializeApp({
    apiKey: "AIzaSyA03J4tz9Vo7bx8U8SPSLrrB--Jgq3nqVw",
    authDomain: "water-b8bc2.firebaseapp.com",
    projectId: "water-b8bc2",
    storageBucket: "water-b8bc2.appspot.com",
    messagingSenderId: "612633937048",
    appId: "1:612633937048:web:c1f44776512ac9901efced",
    measurementId: "G-CP6RZQGRGT"
});

const messaging = firebase.messaging();

//
// messaging.onBackgroundMessage(function(payload) {
//     console.log('[firebase-messaging-sw.js] Received background message ', payload);
//     const notificationTitle = 'Background Message Title';
//     const notificationOptions = {
//         body: 'Background Message body.',
//         icon: '/firebase-logo.png'
//     };
//
//     self.registration.showNotification(notificationTitle,
//         notificationOptions);
//
// });


// messaging.setBackgroundMessageHandler(function(payload) {
//     console.log('[firebase-messaging-sw.js] Received background message ', payload);
//     // Customize notification here
//     const notificationTitle = 'Background Message Title';
//     const notificationOptions = {
//         body: 'Background Message body.',
//         icon: 'https://i.pinimg.com/736x/61/f1/cb/61f1cb5e0db9cb346501c68fdf75a10d.jpg',
//
//     };
//
//
//     self.addEventListener('notificationclick', function (event) {
//         event.notification.close();
//
//         var clickResponsePromise = Promise.resolve();
//         clickResponsePromise = clients.openWindow('facebook');
//
//         event.waitUntil(Promise.all([clickResponsePromise, self.analytics.trackEvent('notification-click')]));
//     });
//
//
//
//     return self.registration.showNotification(notificationTitle,
//         notificationOptions);
// });
