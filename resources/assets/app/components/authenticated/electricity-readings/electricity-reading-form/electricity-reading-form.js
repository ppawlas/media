import angular from "angular";
import uiRouter from "angular-ui-router";
import ElectricityReadingFormComponent from "./electricity-reading-form.component";

let ElectricityReadingFormModule = angular
    .module('app.components.authenticated.electricity-readings.form', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.electricity-readings.create', {
                url: '/electricity-readings/create',
                component: 'electricityReadingForm'
            })
            .state('app.authenticated.electricity-readings.edit', {
                url: '/electricity-readings/edit/:id',
                component: 'electricityReadingForm',
                resolve: {
                    electricityReading: (ElectricityReadings, $stateParams) => ElectricityReadings.show($stateParams.id)
                }
            });
    })
    .component('electricityReadingForm', ElectricityReadingFormComponent)
    .name;

export default ElectricityReadingFormModule;