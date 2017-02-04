import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingsPredictionComponent from "./electricity-readings-prediction.component";

let ElectricityReadingsPredictionModule = angular
    .module('app.components.authenticated.electricity-readings.prediction', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings.prediction', {
                url: '/electricity-readings/prediction',
                component: 'electricityReadingsPrediction'
            });
    })
    .component('electricityReadingsPrediction', ElectricityReadingsPredictionComponent)
    .name;

export default ElectricityReadingsPredictionModule;