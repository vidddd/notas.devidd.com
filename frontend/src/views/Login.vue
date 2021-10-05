<template>
  <section class="section has-background-white-bis">
    <div class="columns is-centered">
        <div class="column is-8-tablet is-6-desktop is-4-widescreen">
            <div class="box">
                <div class="card-content">
                    <form @submit.prevent="loginUser" method="post" class="form-signin">
                        <h2 class="title has-text-centered is-size-3">Please log in</h2>
                        <div class="field">
                            <label class="label" for="username">Username</label>
                            <div class="control">
                                <input class="input" type="text" v-model="username" id="username" name="_username" required="required" placeholder="Username" value="">
                            </div>
                        </div>
                        <div class="field">
                            <label class="label" for="password">Password</label>
                            <input class="input" type="password" v-model="password" id="password" name="_password" required="required" placeholder="Password">
                        </div>

                        <div class="field">
                            <button class="button is-medium is-primary is-fullwidth" type="submit">Log in</button>
                        </div>
                    </form>
                    <div class="error-login" v-if="error">{{ error }}</div>
                </div>
            </div>
        </div>
    </div>
    </section>
</template>
<script>
/* eslint-disable */
import axios from "axios";

export default {
  data: () => {
    return {
      username: "",
      password: "",
      error: false
    };
  },
  methods: {
    loginUser() {
        try {
          const user = { username: this.username, password: this.password };
          axios.post('login', user)
                  .then(response => {
                    localStorage.setItem('token', response.data.token);
                    localStorage.setItem('username', response.data.username);
                    this.$router.push({path: "/"});
                    }).catch((error) => {
                        if( error.response ){
                            this.error = 'Fallo de inicio de sesion';
                        }
                    });
        } catch (e) {
            this.error = 'usuario o contraseña incorrectos' 
            console.log('this.errors');
        }
    },
  },
};
</script>