importScripts('https://www.gstatic.com/firebasejs/12.16.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/12.16.0/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyC_fqN2O0wIX7c2qMYJriVogj7wNjyAtfA",
    authDomain: "medicine-reminder-1695e.firebaseapp.com",
    projectId: "medicine-reminder-1695e",
    storageBucket: "medicine-reminder-1695e.firebasestorage.app",
    messagingSenderId: "517819965549",
    appId: "1:517819965549:web:462b03663a81fc8a4a5f64"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {

    console.log('Background Message Received:', payload);

    self.registration.showNotification(
        payload.notification.title,
        {
            body: payload.notification.body,
            icon: 'icon-192.png'
        }
    );

});