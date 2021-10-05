<template>
    <div id="nuevaNota" class="modal is-active">
        <form id="app" @submit="checkForm" method="post">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Nueva Nota</p>
                    <button class="delete" aria-label="close" @click="$emit('close')"></button>
                </header>
                <section class="modal-card-body">
                    <div class="bd-snippet bd-is-vertical bd-is-size-2">
                        <div class="field">
                            <div class="control is-expanded">
                                <input class="input" type="text" required="required" v-model="titulo" placeholder="Titulo">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control is-expanded">
                                <textarea class="textarea" required="required" v-model="nota" placeholder="Nota"></textarea>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success">Guardar</button>
                    <button class="button" @click="$emit('close')">Cancelar</button>
                </footer>
            </div>
        </form>
    </div>
</template>
<script>
/* eslint-disable */
import axios from "axios";
export default {             
  name: "NuevaNota",
  data() {
    return {
      titulo: '',
      nota: '',
      errors: []
    };
  },
  mounted() {
  },
  methods:{
    checkForm: function (e) {
      if (this.titulo && this.nota) {
        this.guardaNota() 
      }

      this.$parent.$options.methods.getNotas()
      this.$emit('close')

      e.preventDefault();
    },
    async guardaNota() {
        try {
            await axios.post('addNota', {
                    titulo: this.titulo,
                    nota: this.nota
                } );
            this.titulo = '';
            this.nota = '';
            this.$parent.getNotas();

        } catch (e) {
            this.errors.push(e)
            console.log(this.errors);
        }
    },
   },
};
</script>