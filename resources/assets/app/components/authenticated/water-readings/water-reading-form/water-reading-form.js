import angular from "angular";
import uiRouter from "angular-ui-router";
import WaterReadingFormComponent from "./water-reading-form.component";

let WaterReadingFormModule = angular
    .module('app.components.authenticated.water-readings.form', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.water-readings.create', {
                url: '/water-readings/create',
                component: 'waterReadingForm'
            })
            .state('app.authenticated.water-readings.edit', {
                url: '/water-readings/edit/:id',
                component: 'waterReadingForm',
                resolve: {
                    waterReading: (WaterReadings, $stateParams) => WaterReadings.show($stateParams.id)
                }
            });
    })
    .component('waterReadingForm', WaterReadingFormComponent)
    .name;

export default WaterReadingFormModule;