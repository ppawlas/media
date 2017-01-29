import angular from "angular";
import uiRouter from "angular-ui-router";
import GasReadingsRestoreComponent from "./gas-readings-restore.component";

let GasReadingsRestoreModule = angular
    .module('app.components.authenticated.gas-readings.restore', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-readings.restore', {
                url: '/gas-readings/restore',
                component: 'gasReadingsRestore'
            });
    })
    .component('gasReadingsRestore', GasReadingsRestoreComponent)
    .name;

export default GasReadingsRestoreModule;