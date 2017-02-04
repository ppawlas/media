import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingsList from "./electricity-readings-list/electricity-readings-list";
import ElectricityReadingForm from "./electricity-reading-form/electricity-reading-form";
import ElectricityReadingsRestore from "./electricity-readings-restore/electricity-readings-restore";
import ElectricityReadingsCharge from "./electricity-readings-charge/electricity-readings-charge";
import ElectricityReadingsPrediction from "./electricity-readings-prediction/electricity-readings-prediction";
import ElectricityReadingsService from "./electricity-readings.service";
import ElectricityReadingsComponent from "./electricity-readings.component";

let ElectricityReadingsModule = angular
    .module('app.components.authenticated.electricity-readings', [
        uiRouter,
        ElectricityReadingsList,
        ElectricityReadingForm,
        ElectricityReadingsRestore,
        ElectricityReadingsCharge,
        ElectricityReadingsPrediction
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings', {
                abstract: true,
                component: 'electricityReadings'
            });
    })
    .service('ElectricityReadings', ElectricityReadingsService)
    .component('electricityReadings', ElectricityReadingsComponent)
    .name;

export default ElectricityReadingsModule;