import angular from "angular";
import uiRouter from "angular-ui-router";
import WaterReadingsList from "./water-readings-list/water-readings-list";
import WaterReadingForm from "./water-reading-form/water-reading-form";
import WaterReadingsRestoreComponent from "./water-readings-restore/water-readings-restore";
import WaterReadingsService from "./water-readings.service";
import WaterReadingsComponent from "./water-readings.component";

let WaterReadingsModule = angular
    .module('app.components.authenticated.water-readings', [
        uiRouter,
        WaterReadingsList,
        WaterReadingForm,
        WaterReadingsRestoreComponent
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