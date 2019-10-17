<template>
    <md-list-item v-if="item">
        <md-avatar>
            <svg height="36" width="36">
                <polygon :points="getPoints(item.type)" :fill="item.color" />
                Sorry, your browser does not support inline SVG.
            </svg>
        </md-avatar>

        <span class="md-list-item-text">{{ item.description }}</span>
    </md-list-item>
</template>

<script>
    export default {
        props: {
            item: {
                type: Object,
                default: {}
            }
        },
        methods: {
            getPoints(n) {
                const R = 18;
                const x0 = R;
                const y0 = R;
                const fi = 360/(2*n);
                const points = [];

                for(let i = 0; i < n; i++) {
                    let x = x0 + (R * Math.cos(fi + ((2 * Math.PI * i) / n)));
                    let y = y0 + (R * Math.sin(fi + ((2 * Math.PI * i) / n)));

                    points.push(`${x} ${y}`);
                }

                return points.join(',')
            }
        },
    }
</script>

<style scoped>

</style>
