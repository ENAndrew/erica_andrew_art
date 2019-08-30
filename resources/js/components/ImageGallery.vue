<template>
	<div class="image-gallery-component">
		<div class="container images">
			<div class="image-wrapper" v-for="image in images" v-on:click="openModal(image)">
				<img :src="image.thumbnail_url">
			</div>
		</div>

		<div class="image-modal" v-if="selectedImage.id" v-on:click="closeModal" :style="{ 'top': this.modalTop }">
			<img :src="selectedImage.url">

			<p v-if="selectedImage.description">{{ selectedImage.description }}</p>
		</div>

		<div class="shade" v-if="selectedImage.id" v-on:click="closeModal"></div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				selectedImage: {},
				modalTop: 0
			}
		},

		props: {
			images: {
				type: Array,
				default() {
					return [];
				}
			}
		},

		methods: {
			openModal(image) {
				this.selectedImage = image;

				let offset = 60;
				this.modalTop = jQuery(document).scrollTop() + offset + 'px';
			},

			closeModal() {
				this.selectedImage = {};
			}
		}
	}
</script>
