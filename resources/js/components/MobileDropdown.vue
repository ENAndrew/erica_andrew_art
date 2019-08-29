<template>
	<div class="mobile-dropdown-component">
		<div class="title pull-left">
			<h3>Erica Andrew Art</h3>
		</div>

		<div class="icon">
			<i v-on:click="openDrop = !openDrop" class="fa fa-bars"></i>
		</div>

		<div v-if="openDrop" class="mobile-links">
			<ul>
				<a href="/">
					<li>Home</li>
				</a>

				<a href="/digital">
					<li>Digital Artwork</li>
				</a>

				<a href="/traditional">
					<li>Traditional Artwork</li>
				</a>

				<a href="/design">
					<li>Development/Design</li>
				</a>

				<a href="/contact">
					<li class="no-border">Contact</li>
				</a>
			</ul>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				openDrop: false
			}
		}
	}
</script>
