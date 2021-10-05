import axios from "axios";
import Cookies from "js-cookie";

export default {
  setUserLogged(userLogged) {
    Cookies.set("userNotasDevidd", userLogged, { expires: 7 }); // days
  },
  getUserLogged() {
    return Cookies.get("userNotasDevidd");
  },
  deleteUserLogged() {
    Cookies.remove('userNotasDevidd');
  },
  getUserLoggedName() {
    return Cookies.get("userNotasDevidd", "username");
  },
  /*
  register(email, password) {
    const user = { email, password };
    return axios.post("regiser", user);
  },*/
  login(username, password) {
    const user = { username, password };
    return axios.post("login", user);
  }
};