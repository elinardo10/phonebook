<template>
	<div>
		<button class="btn-primary" @click="openAdd = true">Add contact</button>

		<add v-if="openAdd" @closeAdd="openAdd = false"></add>
	</div>
</template>

<script>
	import Add from '../contacts/Add.vue';
	
	export default {
		components: {'add': Add},
		data(){

			return{
				openAdd: false

			}
		},

		methods: {
			escapeKeyListener(evt) {
				if (evt.keyCode === 27 && this.openAdd) {
					this.openAdd = false;
				}
			}
		},

		created() {
			document.addEventListener('keyup', this.escapeKeyListener);
		},
		destroyed() {
			document.removeEventListener('keyup', this.escapeKeyListener);
		},


	}
</script>