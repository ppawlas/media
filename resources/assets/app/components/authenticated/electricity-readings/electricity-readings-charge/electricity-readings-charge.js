import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingsChargeComponent from "./electricity-readings-charge.component";

let ElectricityReadingsChargeModule = angular
    .module('app.components.authenticated.electricity-readings.charge', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings.charge', {
                url: '/electricity-readings/charge',
                component: 'electricityReadingsCharge',
                resolve: {
                    electricityCharge: ElectricityReadings => ElectricityReadings.getCharge()
                }
            });
    })
    .component('electricityReadingsCharge', ElectricityReadingsChargeComponent)
    .name;

export default ElectricityReadingsChargeModule;