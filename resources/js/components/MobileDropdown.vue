<template>
	<div class="mobile-dropdown-component">
		<div class="icon">
			<i v-on:click="openDrop = !openDrop" class="fa fa-bars"></i>
		</div>

		<div v-if="openDrop" class="mobile-links">
			<ul>
				<li>
					<a href="/home">Home</a>
				</li>

				<li>
					<a href="/digital">Digital Artwork</a>
				</li>
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