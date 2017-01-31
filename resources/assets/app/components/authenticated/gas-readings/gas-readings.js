import angular from "angular";
import uiRouter from "angular-ui-router";
import GasReadingsList from "./gas-readings-list/gas-readings-list";
import GasReadingForm from "./gas-reading-form/gas-reading-form";
import GasReadingsRestore from "./gas-readings-restore/gas-readings-restore";
import GasReadingsService from "./gas-readings.service";
import GasReadingsComponent from "./gas-readings.component";

let GasReadingsModule = angular
    .module('app.components.authenticated.gas-readings', [
        uiRouter,
        GasReadingsList,
        GasReadingForm,
        GasReadingsRestore
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-readings', {
                abstract: true,
                component: 'gasReadings'
            });
    })
    .service('GasReadings', GasReadingsService)
    .component('gasReadings', GasReadingsComponent)
    .name;

export default GasReadingsModule;