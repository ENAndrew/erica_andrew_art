<template>
	<div class="parallax-component" :style="styles">
		<slot></slot>
	</div>
</template>

<script>
	export default {
		mounted() {
			jQuery(window).on('scroll', e => {
				this.scroll = jQuery(document).scrollTop();
			});

			this.scroll = jQuery(document).scrollTop();
		},

		data() {
			return {
				scroll: 0
			}
		},

		props: {
			src: {
				type: String,
				default: ''
			},

			speed: {
				type: Number,
				default: 1.0
			}
		},

		computed: {
			styles() {
				let styles = {};
				let value = 0;

				value = this.scroll / this.scrollHeight();
				value *= 100;
				value += 50;
				value *= this.speed;
				value = this.clamp(value, 0, 100);

				styles['background-image'] = `url('${this.src}')`;
				styles['background-position-y'] = value + '%';

				return styles;
			}
		},

		methods: {
			viewportHeight() {
				return jQuery(window).outerHeight();
			},

			scrollHeight() {
				return this.pageHeight() - this.viewportHeight();
			},

			pageHeight() {
				return jQuery('body').outerHeight();
			},

			clamp(value, min, max) {
				if (value < min) return min;
				if (value > max) return max;
				return value;
			}
		}
	}
</script>
