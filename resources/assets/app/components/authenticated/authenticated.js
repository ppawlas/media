import angular from "angular";
import uiRouter from "angular-ui-router";
import Dashboard from "./dashboard/dashboard";
import ElectricityReadings from "./electricity-readings/electricity-readings";
import GasInvoices from "./gas-invoices/gas-invoices";
import GasReadings from "./gas-readings/gas-readings";
import WaterReadings from "./water-readings/water-readings";
import AuthenticatedComponent from "./authenticated.component";

let AuthenticatedModule = angular
    .module('app.components.authenticated', [
        uiRouter,
        Dashboard,
        ElectricityReadings,
        GasInvoices,
        GasReadings,
        WaterReadings
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated', {
                abstract: true,
                component: 'authenticated',
                resolve: {
                    auth: Auth => Auth.isAuthenticated()
                }
            });
    })
    .component('authenticated', AuthenticatedComponent)
    .name;

export default AuthenticatedModule;