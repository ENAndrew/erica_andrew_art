<template>
	<div class="image-editor-component">
		<form action="/admin/images" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="_token" :value="csrfToken">

			<input id="image-file-input" type="file" name="images[]" mutiple v-on:input="triggerUpload">

			<input type="text" name="type" v-model="currentType.name" style="display: none;">
		</form>

		<div class="type-links">
			<div class="type-link" v-for="type in types" v-on:click="switchImages(type)" :class="{ active: currentType.name === type.name }">{{ type. name }}</div>
		</div>

		<div class="add-header">
			<h3>Add a new image:</h3>

			<div class="add-photo-button">
				<button class="btn btn-teal" v-on:click="promptUpload">
					<i class="fa fa-photo"></i> Add Images
				</button>
			</div>
		</div>

		<draggable v-model="imageSet" class="image-set">
			<div class="image" v-for="image in imageSet" :style="`background-image: url('${image.thumbnail_url}');`">
				<i title="Delete" class="fa fa-lg fa-times" v-on:click="remove(image)"></i>
			</div>
		</draggable>
	</div>
</template>

<script>
	import draggable from 'vuedraggable'

	export default {
		components: {
			draggable
		},

		mounted() {
			this.mutableImages = this.images.slice();

			for (let type of this.types) {
				if (type.name === 'Traditional') this.currentType = type;
			}

			for (let image of this.mutableImages) {
				if (image.type_id === this.currentType.id) this.imageSet.push(image);
			}
		},

		data() {
			return {
				imageSet: [],
				mutableImages: [],
				currentType: {},
				awaitingImages: true,
				waiting: false
			}
		},

		computed: {
			csrfToken() {
				return jQuery('meta[name="csrf-token"]').attr('content');
			}
		},

		props: {
			types: {
				type: Array,
				default() {
					return [];
				}
			},

			images: {
				type: Array,
				default() {
					return [];
				}
			}
		},

		methods: {
			switchImages(type) {
				this.currentType = type;
				this.imageSet = [];

				for (let image of this.mutableImages) {
					if (image.type_id === type.id) this.imageSet.push(image);
				}
			},

			triggerUpload() {
				this.waiting = true;

				jQuery(this.$el).find('#image-file-input').parents('form').submit();
			},

			promptUpload() {
				jQuery(this.$el).find('#image-file-input').trigger('click');
			},

			remove(image) {
				if (window.confirm('Do you want to permanently delete this image?')) {
					this.waiting = true;

					axios.delete(`/admin/images/${image.id}`)
						.then(response => {
							let index = this.mutableImages.indexOf(image);

							if (index >= 0) this.mutablePhotos.splice(index, 1);

							this.waiting = false;

							this.switchImages(this.currentType);
						})
						.catch(error => {
							if (console && console.error) console.error(error);
						});
				}

				return false;
			}
		}
	}
</script>
