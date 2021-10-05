<template>
    <div id="message-pane" class="column is-8 message is-fullheight">
        <div class="box message-preview">
            <div class="top">
                <div class="address">
                    <div class="titulo">{{ titulo }}</div> 
                </div> 
                <hr> 
                <div class="content"><textarea style="width:100%;min-height:900px;" v-model="nota"></textarea></div>
            </div>
        </div>
    </div>
</template>
<script>
/* eslint-disable */
import axios from 'axios';
export default {
  name: "Nota",
  data() {
        return { 
          id: 0,
          titulo: "", 
          nota: "", 
          errors: []
        }
  },
  created () {
    this.getContent(this.$route.params.id, this.$route.params.token);
  },
  updated () {
    if(this.$route.params.id) {
      try {
        axios.post('updateNota', {
                      id: this.$route.params.id,
                      token: this.$route.params.token,
                      nota: this.nota
              });
          } catch (e) {
            console.log(e);
          }
      }
  },
  beforeRouteUpdate (to, from, next) {
    this.getContent(to.params.id, to.params.token);
    next()
  },
  methods: {
    getContent (id, token) {
    axios.get(`nota/${id}/${token}`)
      .then(response => {
        this.titulo = response.data.titulo
        this.nota = response.data.nota
      })
      .catch(e => {
        this.errors.push(e)
      })
    },
  }
};
</script>