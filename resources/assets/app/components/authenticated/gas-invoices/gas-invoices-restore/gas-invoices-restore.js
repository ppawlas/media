import angular from "angular";
import uiRouter from "angular-ui-router";
import GasInvoicesRestoreComponent from "./gas-invoices-restore.component";

let GasInvoicesRestoreModule = angular
    .module('app.components.authenticated.gas-invoices.restore', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-invoices.restore', {
                url: '/gas-invoices/restore',
                component: 'gasInvoicesRestore'
            });
    })
    .component('gasInvoicesRestore', GasInvoicesRestoreComponent)
    .name;

export default GasInvoicesRestoreModule;