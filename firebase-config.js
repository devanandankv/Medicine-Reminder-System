// Import Firebase App
import { initializeApp } from "https://www.gstatic.com/firebasejs/12.16.0/firebase-app.js";

// Import Firebase Messaging
import {
    getMessaging,
    getToken,
    onMessage
} from "https://www.gstatic.com/firebasejs/12.16.0/firebase-messaging.js";


// Firebase Configuration
const firebaseConfig = {

    apiKey: "AIzaSyC_fqN2O0wIX7c2qMYJriVogj7wNjyAtfA",

    authDomain: "medicine-reminder-1695e.firebaseapp.com",

    projectId: "medicine-reminder-1695e",

    storageBucket: "medicine-reminder-1695e.firebasestorage.app",

    messagingSenderId: "517819965549",

    appId: "1:517819965549:web:462b03663a81fc8a4a5f64"

};


// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Initialize Messaging
const messaging = getMessaging(app);


// Register Firebase Messaging Service Worker
navigator.serviceWorker.register("firebase-messaging-sw.js")
.then((registration) => {

    console.log("Firebase Messaging Service Worker Registered");

    Notification.requestPermission()
    .then((permission) => {

        if(permission === "granted")
        {
            console.log("Notification Permission Granted");

            getToken(messaging, {

                vapidKey: "BLxMys2RfC-50XitsxD6WwStCL9PItdcqApmteK79lp8DUYktUmHMhKHsmYZzJMNJCd3quipNb-dcU_w-EyFG_w",

                serviceWorkerRegistration: registration

            })

            .then((currentToken) => {

                if(currentToken)
                {
                    console.log("FCM Token:");
                    console.log(currentToken);

                    // Save token to database
                    fetch("save_token.php", {

                        method: "POST",

                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },

                        body: "token=" + encodeURIComponent(currentToken)

                    })

                    .then(response => response.text())

                    .then(data => {

                        console.log("Token Save Status:", data);

                    })

                    .catch(error => {

                        console.log("Save Token Error:", error);

                    });

                }
                else
                {
                    console.log("No token available");
                }

            })

            .catch((error) => {

                console.log("Token Error:", error);

            });

        }
        else
        {
            console.log("Notification Permission Denied");
        }

    });

})

.catch((error) => {

    console.log("Service Worker Registration Error:", error);

});


// Listen for foreground messages
onMessage(messaging, (payload) => {

    console.log("Message received:", payload);

    if (payload.notification) {

        new Notification(
            payload.notification.title,
            {
                body: payload.notification.body,
                icon: "icon-192.png"
            }
        );

    }

});