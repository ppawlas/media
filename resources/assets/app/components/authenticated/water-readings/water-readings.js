import angular from "angular";
import uiRouter from "angular-ui-router";
import WaterReadingsList from "./water-readings-list/water-readings-list";
import WaterReadingsForm from "./water-reading-form/water-reading-form";
import WaterReadingsService from "./water-readings.service";
import WaterReadingsComponent from "./water-readings.component";

let WaterReadingsModule = angular
    .module('app.components.authenticated.water-readings', [
        uiRouter,
        WaterReadingsList,
        WaterReadingsForm
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.water-readings', {
                abstract: true,
                component: 'waterReadings'
            });
    })
    .service('WaterReadings', WaterReadingsService)
    .component('waterReadings', WaterReadingsComponent)
    .name;

export default WaterReadingsModule;