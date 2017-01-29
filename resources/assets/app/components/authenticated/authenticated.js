import angular from "angular";
import uiRouter from "angular-ui-router";
import Dashboard from "./dashboard/dashboard";
import WaterReadings from "./water-readings/water-readings";
import AuthenticatedComponent from "./authenticated.component";

let AuthenticatedModule = angular
    .module('app.components.authenticated', [
        uiRouter,
        Dashboard,
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