<template>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card card-default">
				<div class="card-header">Home da pagina</div>

				<div class="card-body">

					<button class="btn-primary" @click="openAdd = true">Add contact</button>
					<br>
					<span class="float-right" v-if="loading">
						<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
					</span>
					<input v-model="searchQuery" class="form-control form-control-sm" type="search" placeholder="procurar" >
					
					<br>
					<table class="table table-hover table-striped table-bordered">
						<tbody>
							<tr v-for="contact in temp">
								<td>{{contact.name}}</td>


								<td width="1%" nowrap="nowrap">
									<button @click="abrirShow(contact)" title="Detalhes" class="btn btn-success btn-sm" ><i class="fa fa-eye" aria-hidden="true" alt="Detalhes"></i></button>

									<button @click="abrirUpdate(contact)"><i class="fa fa-edit" aria-hidden="true" alt="Detalhes"></i></a></button>

								</td>
							</tr>
						</tbody>

					</table>
					
				</div>
			</div>
		</div>

		<add v-if="openAdd"  @add="addContact" @closeAdd="openAdd = false"></add>
		<show v-if="openShow" :contact="selected_contact" @closeShow="openShow = false"></show>
		<update v-if="openEdit"
		@update="updateContact"
		@deletar="del(selected_contact.id)" 
		:contact="selected_contact" 
		@closeShow="openEdit = false"
		:carregar="loading"
		></update>
		
		
	</div>
</template>

<script>
	import Add from './contacts/Add.vue';
	import Show from './contacts/Show.vue';
	import Update from './contacts/Update.vue';
	
	export default {
		components: {
			'add': Add,
			'show': Show,
			'update':Update,
			
		},

		data(){
			return {
				selected_contact: {},
				contacts:[],
				errors:{},
				openShow: false,
				openAdd: false,
				openEdit: false,
				loading: false,
				searchQuery: '',
				temp: ''
			}
		},

		methods: {
			abrirShow(item){
				this.selected_contact = item;
				this.openShow = true;
			},

			abrirUpdate(item){
				this.selected_contact = item;
				this.openEdit = true;
			},
        //escultando eventos
			addContact(item) {
				
				const i = this.temp.findIndex(contact => contact.name > item.name);
			if (i !== -1)
				this.temp.splice(i, 0, item)
				
				else
				this.contacts.push(item);
				this.openAdd = false;
			},
			
			updateContact(item) {
				const i = this.temp.findIndex(contact => contact.id === item.id);
				this.temp.splice(i, 1, item);
				this.openEdit = false;

			},

			del(id){
				this.loading = !this.loading

				axios.delete(`/phonebook/${id}`)
				.then((response)=> {
					const i = this.temp.findIndex(contact => contact.id === id);
					this.temp.splice(i, 1);
					this.loading = !this.loading
					this.openEdit = false;
				})
				.catch((error) => this.errors = error.response.data.errors)

			},

			escapeKeyListener(evt) {
				if (evt.keyCode === 27 && this.openAdd ) {
					this.openAdd = false;
					
				}
				
			}

		},

		watch:{
			searchQuery(){
				if(this.searchQuery.length >= 0){
					// ao definir meu objseto "temp" = a contacts q é meu objeto q tem os dados
					//do banco, o uso para listar no meu for each e poder buscar os dados
					this.temp = this.contacts.filter((item) =>{
						return Object.keys(item).some((key) =>{
							let string = String(item[key])

						return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
						})
						
					});
				}else{

					this.temp = this.contacts
				}


			}

		},

		mounted(){
			axios.get('/phonebook',)
			.then((response)=> this.temp = this.contacts = response.data)

			.catch((error) => this.errors = error.response.data.errors)
		},

		created() {
			document.addEventListener('keyup', this.escapeKeyListener);
		},
		destroyed() {
			document.removeEventListener('keyup', this.escapeKeyListener);
		}

	}
</script>