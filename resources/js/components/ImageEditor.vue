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
				<i title="Edit Description" class="fa fa-lg fa-edit" v-on:click="openEdit(image)"></i>

				<i title="Delete" class="fa fa-lg fa-times" v-on:click="remove(image)"></i>
			</div>
		</draggable>

		<button v-show="imageSet.length > 1" class="btn btn-teal save-order" v-on:click="saveOrder">
			<i class="fa fa-list-ul"></i> Save Image Order
		</button>

		<div class="waiting" v-if="waiting">
			<i class="fa fa-lg fa-spin fa-cog"></i>
		</div>

		<div class="description-modal" v-if="selectedImage.id" :style="{ 'top': this.modalTop }">
			<i class="fa fa-lg fa-times" v-on:click="closeEdit"></i>

			<h4>Enter a description:</h4>

			<p v-if="error.length" style="color: red;">{{ error }}</p>

			<input class="form-control" type="text" v-model="imageDescription">

			<button class="btn btn-teal" v-on:click="updateImage">Update</button>
		</div>

		<div class="shade" v-if="selectedImage.id" v-on:click="closeEdit"></div>
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
				waiting: false,
				selectedImage: {},
				imageDescription: '',
				modalTop: '',
				error: ''
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

			updateImage() {
				this.waiting = true;

				if (!this.imageDescription) {
					this.error = 'Oops, please enter a description.';

					return false;
				}

				let params = {
					description: this.imageDescription,
					id: this.selectedImage.id
				};

				axios.patch(`/admin/images/${this.selectedImage.id}`, params)
					.then(response => {
						if (response.data.status === 200) {
							let index = this.mutableImages.indexOf(this.selectedImage);

							if (index >= 0) this.mutableImages[index].description = response.data.description;
						} else {
							this.error = response.data.message;

							return false;
						}
					})
					.catch(error => {
						if (console && console.error) console.error(error);
					})
					.then(response => {
						this.waiting = false;
						this.selectedImage = {};
						this.imageDescription = '';

						if (this.error.length) this.error = '';
					});

				return false;
			},

			remove(image) {
				if (window.confirm('Do you want to permanently delete this image?')) {
					this.waiting = true;

					axios.delete(`/admin/images/${image.id}`, { data: image })
						.then(response => {
							let index = this.mutableImages.indexOf(image);

							if (index >= 0) this.mutableImages.splice(index, 1);

							this.waiting = false;

							this.switchImages(this.currentType);
						})
						.catch(error => {
							if (console && console.error) console.error(error);
						});
				}

				return false;
			},

			saveOrder() {
				this.waiting = true;

				let image, images = [];

				for (let i = 0; i < this.imageSet.length; ++i) {
					image = this.imageSet[i];

					images.push(image.id);
				}

				axios.post(`/admin/images/order`, { images })
					.then(response => {
						this.waiting = false;
					})
					.catch(error => {
						if (console && console.error) console.error(error);
					});
			},

			openEdit(image) {
				this.selectedImage = image;
				this.imageDescription = image.description;

				let offset = 160;
				this.modalTop = jQuery(document).scrollTop() + offset + 'px';
			},

			closeEdit() {
				this.selectedImage = {};
				this.imageDescription = '';
				this.error = '';
				this.waiting = false;
			}
		}
	}
</script>
