import angular from "angular";
import uiRouter from "angular-ui-router";
import WaterReadingsRestoreComponent from "./water-readings-restore.component";

let WaterReadingsRestoreModule = angular
    .module('app.components.authenticated.water-readings.restore', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.water-readings.restore', {
                url: '/water-readings/restore',
                component: 'waterReadingsRestore'
            });
    })
    .component('waterReadingsRestore', WaterReadingsRestoreComponent)
    .name;

export default WaterReadingsRestoreModule;