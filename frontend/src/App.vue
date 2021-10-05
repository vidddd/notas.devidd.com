<template>
  <div>
    <Nav></Nav>
      <router-view />
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>

<style>
@import "~bulma/css/bulma.css";
@import "./assets/css/styles.css";
</style>

<script>
/* eslint-disable */
import auth from "@/logic/auth";
import Nav from "./components/Nav.vue";
export default {
  title: "notas.devidd.com",
  name: "app",
  computed: {
    userLogged() {
      return auth.getUserLogged();
    }
  },
  components: {
    Nav,
  },
  data() {
    return {};
  },
};
</script>

<style>
body,
html {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  background: #e0ddda;
  width: 100%;
  height: 100%;
}
</style>