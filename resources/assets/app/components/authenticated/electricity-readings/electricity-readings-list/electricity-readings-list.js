import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingsListComponent from "./electricity-readings-list.component";

let ElectricityReadingsListModule = angular
    .module('app.components.authenticated.electricity-readings.list', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings.list', {
                url: '/electricity-readings/list',
                component: 'electricityReadingsList',
                resolve: {
                    electricityReadings: ElectricityReadings => ElectricityReadings.index()
                }
            });
    })
    .component('electricityReadingsList', ElectricityReadingsListComponent)
    .name;

export default ElectricityReadingsListModule;