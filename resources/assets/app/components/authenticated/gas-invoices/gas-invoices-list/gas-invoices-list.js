import angular from "angular";
import uiRouter from "angular-ui-router";
import GasInvoicesListComponent from "./gas-invoices-list.component";

let GasInvoicesListModule = angular
    .module('app.components.authenticated.gas-invoices.list', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-invoices.list', {
                url: '/gas-invoices/list',
                component: 'gasInvoicesList',
                resolve: {
                    gasInvoices: GasInvoices => GasInvoices.index()
                }
            });
    })
    .component('gasInvoicesList', GasInvoicesListComponent)
    .name;

export default GasInvoicesListModule;