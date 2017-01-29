import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingsRestoreComponent from "./electricity-readings-restore.component";

let ElectricityReadingsRestoreModule = angular
    .module('app.components.authenticated.electricity-readings.restore', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings.restore', {
                url: '/electricity-readings/restore',
                component: 'electricityReadingsRestore'
            });
    })
    .component('electricityReadingsRestore', ElectricityReadingsRestoreComponent)
    .name;

export default ElectricityReadingsRestoreModule;