<template>

	<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
	<a class="navbar-brand" href="#">Crud Laravel+VueJs</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item" v-for="rota in rotas">
					<router-link class="nav-link" :to="rota.path ? rota.path : '/'">
						{{ rota.name }}
					</router-link>
				</li>
			</ul>
		</div>
	</nav>
</template>
<script>
	export default{
		props:['rotas']
	}

</script>
<style>
	

</style>