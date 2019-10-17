<template>
    <div class="md-layout md-gutter md-alignment-center">
        <div class="md-layout-item md-size-100">
            <h2>History</h2>
        </div>

        <div class="md-layout-item md-size-100" v-if="items.length">
            <md-field>
                <label>Revert last revisions</label>
                <md-input v-model="quantity" min="0" type="number"></md-input>
                <md-button class="md-mini md-accent" @click="revertLast">Revert</md-button>
            </md-field>

            <md-list>
                <md-list-item v-for="item in items" :key="item.id">
                    <span class="md-list-item-text" v-if="item.description.length === 1">
                        {{ item.description[0] }}
                    </span>
                    <div class="md-list-item-text" v-else>
                        <ul>
                            <li v-for="description in item.description">{{ description }}</li>
                        </ul>
                    </div>

                    <md-button class="md-icon-button md-list-action" @click="revert(item.id)">
                        <md-icon class="md-accent">delete</md-icon>
                    </md-button>
                </md-list-item>
            </md-list>
        </div>

        <md-empty-state v-else
                        md-rounded
                        md-icon="report_problem"
                        md-label="Nothing to show"
                        md-description="History is empty.">
        </md-empty-state>
    </div>
</template>

<script>
    import RevisionService from "../../services/RevisionService";

    export default {
        data() {
            return {
                quantity: null
            };
        },
        props: {
            items: {
                type: Array,
                Default: []
            }
        },
        methods: {
            revert(id) {
                RevisionService.revert(id).then(response => {
                    this.$emit('updated', response.data);

                    this.$toasted.show('Revision has been reverted!', {
                        type: 'success',
                    });
                });
            },

            revertLast() {
                if (this.quantity > this.items.length) {
                    this.$toasted.show(`Quantity so big, we have only ${this.items.length} revisions`, {
                        type: 'error',
                    });

                    return;
                }

                RevisionService.revertLast(this.quantity).then(response => {
                    this.$emit('updated', response.data);

                    this.$toasted.show('Revisions has been reverted!', {
                        type: 'success',
                    });
                });
            }
        }
    }
</script>
