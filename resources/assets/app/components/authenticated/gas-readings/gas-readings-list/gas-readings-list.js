import angular from "angular";
import uiRouter from "angular-ui-router";
import GasReadingsListComponent from "./gas-readings-list.component";

let GasReadingsListModule = angular
    .module('app.components.authenticated.gas-readings.list', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-readings.list', {
                url: '/gas-readings/list',
                component: 'gasReadingsList',
                resolve: {
                    gasReadings: GasReadings => GasReadings.index()
                }
            });
    })
    .component('gasReadingsList', GasReadingsListComponent)
    .name;

export default GasReadingsListModule;