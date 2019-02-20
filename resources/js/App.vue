<template>
	<div>
		<my-header :rotas="routes"></my-header>
		<div class="container">
			<router-view></router-view>
		</div>
	</div>
</template>

<script>

	import {routes} from './routes';
	import MyHeader from './components/shared/MyHeader.vue'

	export default {

		components: {
			MyHeader

		},

		data(){

			return {
				routes
			}
		}
	}

</script>
