<template>
    <div class="md-layout md-gutter md-alignment-center">
        <md-button class="md-raised md-primary" @click="generate">Generate</md-button>
        <md-button class="md-raised md-primary" @click="changeColor" :disabled="disableChangeColor">
            Change color
        </md-button>
    </div>
</template>

<script>
    import FigureService from "../services/FigureService";

    export default {
        props: {
            disableChangeColor: Boolean,
        },
        methods: {
            generate() {
                FigureService.generate().then(response => {
                    this.$emit('updated', response.data);

                    this.$toasted.show('Figures has been generated!', {
                        type: 'success',
                    });
                });
            },
            changeColor() {
                FigureService.changeColor().then(response => {
                    this.$emit('updated', response.data);

                    this.$toasted.show('Color has been changed!', {
                        type: 'success',
                    });
                });
            }
        }
    }
</script>

