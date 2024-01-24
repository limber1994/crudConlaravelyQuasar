// src/firebase/firebase-login.js

import { auth } from "./index.js";
import { Loading, Notify } from "quasar";
import {
  signInWithEmailAndPassword,
  signInWithPopup,
  FacebookAuthProvider,
} from "firebase/auth";
const loginWithFacebook = () => {
  const provider = new FacebookAuthProvider();

  return signInWithPopup(auth, provider).then(
    (userCredential) => userCredential.user
  );
};
const login = (data) => {
  return new Promise((resolve, reject) => {
    Loading.show();

    signInWithEmailAndPassword(auth, data.email, data.password)
      .then((userCredential) => {
        Loading.hide();
        resolve(userCredential.user);
      })
      .catch((err) => {
        Loading.hide();
        Notify.create({
          type: "negative",
          message: err.message,
        });
        reject(err.message);
      });
  });
};
export { login, loginWithFacebook };
