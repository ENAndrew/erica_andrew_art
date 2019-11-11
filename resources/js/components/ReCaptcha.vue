<template></template>

<script>
	export default {
		mounted() {
			let script = jQuery('<scr' + 'ipt></scr' + 'ipt>');

			script.get(0).onload = this.load.bind(this);

			jQuery('head').append(script);

			script.attr('src', `https://www.google.com/recaptcha/api.js?render=${this.apiKey}`);
		},

		props: {
			apiKey: {
				type: String,
				default: ''
			},

			action: {
				type: String,
				default: 'unknown'
			}
		},

		methods: {
			load(e) {
                grecaptcha.ready(() => {
                    grecaptcha.execute(this.apiKey, { action: this.action }).then(token => {
                        let input = jQuery(`<input name="recaptcha" type="hidden" value="${token}">`);

                        jQuery(this.$el).parents('form').append(input);
                    });
                });
            }
		}
	}
</script>