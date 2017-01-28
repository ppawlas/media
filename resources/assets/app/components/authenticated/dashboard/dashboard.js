import angular from "angular";
import uiRouter from "angular-ui-router";
import DashboardComponent from "./dashboard.component";

let DashboardModule = angular
    .module('app.components.authenticated.dashboard', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.dashboard', {
                url: '/',
                component: 'dashboard'
            });
    })
    .component('dashboard', DashboardComponent)
    .name;

export default DashboardModule;