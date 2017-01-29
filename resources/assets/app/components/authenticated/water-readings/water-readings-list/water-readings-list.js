import angular from "angular";
import uiRouter from "angular-ui-router";
import WaterReadingsListComponent from "./water-readings-list.component";

let WaterReadingsListModule = angular
    .module('app.components.authenticated.water-readings.list', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.water-readings.list', {
                url: '/water-readings/list',
                component: 'waterReadingsList',
                resolve: {
                    waterReadings: WaterReadings => WaterReadings.index()
                }
            });
    })
    .component('waterReadingsList', WaterReadingsListComponent)
    .name;

export default WaterReadingsListModule;