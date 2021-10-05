<template>
    <nav class="navbar has-shadow">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="#">&lg;notas.devidd.com&gt;</a>
                <div class="navbar-burger burger" data-target="navMenu">
                    <span></span><span></span>
                    <span></span>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item has-dropdown is-hoverable">
                    <div v-if="userLogged">
                        <a class="navbar-link">
                            {{ userName }}
                            </a>
                            <div class="navbar-dropdown">
                                <router-link to="/" class="navbar-item">Notas</router-link>
                                <hr class="navbar-divider">
                                <a @click="logout()" class="navbar-item">Salir</a>
                            </div>
                    </div>
                    <div v-else>
                        <router-link class="navbar-link" to="/login">Login</router-link>
                    </div>
                </div>
	        </div>
        </div>
    </nav>
</template>
<script>
export default {
  name: "Nav",
  computed: {
    userLogged() {
      return localStorage.getItem('token');
    },
    userName() {
      return localStorage.getItem('username');
    }
  },
  methods: {
      logout() {
          localStorage.removeItem('token');
          this.$router.push({path: "/login"});
      }
  }
};
</script>