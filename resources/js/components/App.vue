<template>
    <div class="page-container">
        <md-app md-waterfall md-mode="overlap">
            <md-app-toolbar class="md-primary md-large">
                <div class="md-toolbar-row">
                    <span class="md-title">Figure generator</span>
                </div>
            </md-app-toolbar>

            <md-app-content>
                <controls @updated="updated" :disable-change-color="!figures.length" />

                <md-tabs>
                    <md-tab id="tab-posts" md-label="Figures">
                        <figures :items="figures" />
                    </md-tab>
                    <md-tab id="tab-favorites" md-label="History">
                        <revisions :items="revisions" @updated="updated" />
                    </md-tab>
                </md-tabs>

                <br><br>
            </md-app-content>
        </md-app>
    </div>
</template>

<script>
    import FigureService from "../services/FigureService";
    import Figures from './Figures/List';
    import Revisions from './Revisions/List';
    import Controls from './Controls';

    export default {
        data() {
          return {
              figures: [],
              revisions: [],
          }
        },
        components: {
            Figures,
            Revisions,
            Controls,
        },
        created() {
            FigureService.list().then(response => {
                this.figures = response.data.figures;
                this.revisions = response.data.history;
            })
        },
        methods: {
            updated(response) {
                this.figures = response.figures;
                this.revisions = response.history;
            }
        }
    }
</script>
