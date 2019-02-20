<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class=" card-header">
            <slot name="header">
              Cadastrar novo contato
            </slot>
          </div>

          <div class="modal-body">
            <slot name="body">
             
              <div class="form-group">
                 <label for="inputeName">Nome</label>
                 <input type="text" class="form-control" :class="{'is-invalid':errors.name}" id="inputeName" name="name" v-model="contato.name" placeholder="Digite seu nome">
                 <small v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</small>
               </div>

               <div class="form-group">
                <label for="exampleInputPassword1">Telefone</label>
                <input type="number" class="form-control" :class="{'is-invalid':errors.phone}" v-model="contato.phone" name="phone" id="exampleInputPassword1" placeholder="digite seu telefone">
                <small v-if="errors.phone" class="invalid-feedback">{{ errors.phone[0] }}</small>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" :class="{'is-invalid':errors.email}" v-model="contato.email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</small>
              </div>
            
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
          <button @click="delAtivado()" title="Delete Dados" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true" alt="deletar"></i></button>
            <button class="btn btn-primary" @click='close' >cancelar</button>
            <button class="btn btn-success" @click='update'>salvar</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</transition>
</template>

<script>

  import { cloneDeep } from 'lodash';

  export default {

    props: ['contact'],

    data(){
      return{
        contato: {},
        errors:{}
      }
    },

    created() {
      this.contato = cloneDeep(this.contact);
    },

    methods:{

    close(){
      this.$emit('closeShow')
    },

     update(){
        //let uri = 'http://127.0.0.1:8000/phonebook'
          axios.patch(`/phonebook/${this.contato.id}`,this.$data.contato)
            .then((response)=> {
              this.$emit('update', JSON.parse(JSON.stringify(this.contato)));
            })
            .catch((error) => this.errors = error.response.data.errors)
            this.name ='';
      },

      delAtivado(){
        if(confirm('Tem certeza quer excluir? Esse paciente luiz disse q tem agendamento')){

          this.$emit('deletar');
       
        }
      },
    }

  }

</script>

<style>
  .modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
  }

  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }

  .modal-container {
    width: 300px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
    transition: all .3s ease;
    font-family: Helvetica, Arial, sans-serif;
  }

  .modal-header h3 {
    margin-top: 0;
    color: #42b983;
  }

  .modal-body {
    margin: 20px 0;
  }

  .modal-default-button {
    float: right;
  }

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

 .modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>