<template>
  <div id="mail-app" class="columns">
    <div id="message-feed" class="column is-4 messages hero is-fullheight">
      <div class="compose has-text-centered">
        <a class="button is-danger is-large modal-button" @click="showModal = true"><span class="compose">Nueva Nota</span></a>
      </div>
      <div id="inbox-messages" class="inbox-messages">
        <router-link :to="{ name: 'Nota', params: { id: nota.id, token: getToken }}"
                     :key="index"
                     v-for="(nota, index) in notas"
                     :id="['msg-card-' + nota.id ]"
                     class="card card-cursor">
            <div class="card-content">
              <span class="msg-delete" @click="clickDelete(nota.id)"><span>X</span></span>
              <div class="msg-subject">
                <span class="msg-subject"><strong id="fake-subject-1">{{ nota.titulo }}</strong></span>
              </div>
            </div>
        </router-link>
      </div>
    </div>
    <router-view></router-view>
    <NuevaNota v-show="showModal" @close="showModal = false">
    </NuevaNota>
  </div>
</template>

<script>
/* eslint-disable */
import axios from "axios";
import Nota from "./Nota.vue";
import NuevaNota from "./NuevaNota.vue";

export default {
  name: "Notas",
  components: {
    Nota, NuevaNota,
  },
  computed: {
    getToken() {
      return localStorage.getItem("token");
  }},
  data() {
    return {
      notas: [],
      notaActive: [],
      showModal: false,
      activeClass: true
    };
  },
  created() {
    this.getNotas();
  },
  methods: {
    async getNotas() {
      try {
        let token = localStorage.getItem('token');
        let response = await axios.get('notas?token='+token);
        this.notas = response.data;
      } catch (error) {
        console.log(error);
      }
    },
    async deleteNota(id) {
      try {
        let token = localStorage.getItem('token');
        await axios.delete(`deleteNota/${id}/${token}`);
        this.notaActive = []
        this.getNotas()
      } catch (error) {
        console.log(error);
      }
    },
    clickDelete(id){
        this.$confirm(
          {
            message: `Estas Seguro?`,
            button: {
              no: 'No',
              yes: 'Si'
            },
            /**
            * Callback Function
            * @param {Boolean} confirm 
            */
            callback: confirm => {
              if (confirm) {
                this.deleteNota(id)
                this.getNotas()
                this.notaActive = []
              }
            }
          }
        )
      }
  }
};
</script>