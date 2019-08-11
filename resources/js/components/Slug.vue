<template>
    <input :id="id" :name="name" type="text" class="form-control" v-model="val">
</template>

<script>
    export default {
        mounted() {
            this.val = this.value;

            console.log('this happened');

            if(this.val) this.manuallyUpdated = true;

            this.dependentElement = jQuery(`#${this.dependent}`);

            this.dependentElement.on('input', this.update.bind(this));

            jQuery(this.$el).on('input', function(e) {
                let input = e.target;
                let originalCursorPosition = input.selectionStart;

                this.manuallyUpdated = true;

                let value = this.format(jQuery(this.$el).val());

                this.val = value;

                setTimeout(function(){
                    input.selectionStart = originalCursorPosition;
                    input.selectionEnd = originalCursorPosition;
                }.bind(this), 0);

            }.bind(this));

            jQuery(this.$el).on('blur', this.trim.bind(this));
        },

        data() {
            return {
                val: null,
                dependentElement: null,
                manuallyUpdated: false
            };
        },

        props: {
            id: {
                type: String,
                default: 'slug'
            },

            name: {
                type: String,
                default: 'slug'
            },

            value: {
                type: String,
                default: ''
            },

            dependent: {
                type: String,
                default: 'name'
            }
        },

        methods: {
            format(value) {

                //Remove
                value = value.toLowerCase();
                value = value.replace(/['“”’‘]/ig, '');
                value = value.replace(/\W/ig, '-');
                value = value.replace(/-{2,}/ig, '-');

                return value;

            },

            trim() {

                this.val = this.val.trim();

                if(this.val.substr(0,1) === '-') this.val = this.val.substr(1);
                if(this.val.substr(this.val.length - 1, 1) === '-') this.val = this.val.substr(0, this.val.length -1);
            },

            update(e) {
                if(!this.manuallyUpdated) {
                    let value = this.dependentElement.val();

                    value = this.format(value);

                    this.val = value;

                    this.trim();
                }
            }
        }
    }
</script>
