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
                 <input type="text" class="form-control" :class="{'is-invalid':errors.name}" id="inputeName" name="name" v-model="contact.name" placeholder="Digite seu nome">
                 <small v-if="errors.name" class="invalid-feedback">{{ errors.name[0] }}</small>
               </div>

               <div class="form-group">
                <label for="exampleInputPassword1">Telefone</label>
                <input type="number" class="form-control" :class="{'is-invalid':errors.phone}" v-model="contact.phone" name="phone" id="exampleInputPassword1" placeholder="digite seu telefone">
                <small v-if="errors.phone" class="invalid-feedback">{{ errors.phone[0] }}</small>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" :class="{'is-invalid':errors.email}" v-model="contact.email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small v-if="errors.email" class="invalid-feedback">{{ errors.email[0] }}</small>
              </div>
            
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <button class="btn btn-primary" @click='close' >cancelar</button>
            <button class="btn btn-success" @click='save'>salvar</button>
          </slot>
        </div>
      </div>
    </div>
  </div>
</transition>
</template>


<script>
  export default {

    data(){
      return{
        contact:{
          name:'',
          phone:'',
          email:''
        },
        errors:{}
      }
    },

    methods:{

    close(){
      this.$emit('closeAdd')
    },

    save(){
        //let uri = 'http://127.0.0.1:8000/phonebook'
        axios.post('/phonebook',this.$data.contact)
        .then((response)=> {
          this.$emit('add', response.data);
        })

          .catch((error) => this.errors = error.response.data.errors)
          this.name ='';
      }
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