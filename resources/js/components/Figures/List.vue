<template>
    <div class="md-layout md-gutter md-alignment-center">
        <div class="md-layout-item md-size-100">
            <h2>Figures</h2>
        </div>

        <div class="md-layout-item md-size-100" v-if="items.length">
            <md-list>
                <figure-item  v-for="item in items" :item="item" :key="item.descriprion" />
            </md-list>
        </div>

        <md-empty-state v-else
                        md-rounded
                        md-icon="report_problem"
                        md-label="Nothing to show"
                        md-description="We don't have any figures.">
        </md-empty-state>
    </div>
</template>

<script>
    import FigureItem from './Item';

    export default {
        props: {
            items: {
                type: Array,
                Default: []
            }
        },
        components: {
            FigureItem
        }
    }
</script>
