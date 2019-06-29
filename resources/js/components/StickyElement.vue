<script>
	export default {
		beforeMount() {
			window.addEventListener('scroll', this.handleScroll);
			window.addEventListener('resize', this.handleMenu);
		},

		mounted() {
			this.windowWidth = jQuery(window).width();
			this.scrollHeight = jQuery(window).scrollTop();

			if (this.windowWidth <= 768) this.mobile = true;

			this.$nextTick(this.handleScroll);
		},

		data() {
			return {
				scrolled: false,
				windowWidth: null,
				scrollHeight: null,
				mobile: false
			}
		},

		methods: {
			handleScroll() {
				this.scrolled = jQuery(window).scrollTop() > 0;
				this.scrollHeight = jQuery(window).scrollTop();
			},

			handleMenu() {
				this.windowWidth = jQuery(window).width();
			}
		},

		beforeDestroy() {
			window.removeEventListener('scroll', this.handleScroll);
			window.removeEventListener('resize', this.handleMenu);
		}
	}
</script>