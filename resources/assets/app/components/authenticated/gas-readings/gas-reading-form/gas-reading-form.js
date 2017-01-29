import angular from "angular";
import uiRouter from "angular-ui-router";
import GasReadingFormComponent from "./gas-reading-form.component";

let GasReadingFormModule = angular
    .module('app.components.authenticated.gas-readings.form', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-readings.create', {
                url: '/gas-readings/create',
                component: 'gasReadingForm'
            })
            .state('app.authenticated.gas-readings.edit', {
                url: '/gas-readings/edit/:id',
                component: 'gasReadingForm',
                resolve: {
                    gasReading: (GasReadings, $stateParams) => GasReadings.show($stateParams.id)
                }
            });
    })
    .component('gasReadingForm', GasReadingFormComponent)
    .name;

export default GasReadingFormModule;