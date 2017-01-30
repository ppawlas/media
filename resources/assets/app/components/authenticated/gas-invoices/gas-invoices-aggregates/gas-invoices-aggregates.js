import angular from "angular";
import uiRouter from "angular-ui-router";
import GasInvoicesAggregatesComponent from "./gas-invoices-aggregates.component";

let GasInvoicesAggregatesModule = angular
    .module('app.components.authenticated.gas-invoices.aggregates', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-invoices.aggregates', {
                url: '/gas-invoices/aggregates',
                component: 'gasInvoicesAggregates',
                resolve: {
                    aggregates: GasInvoices => GasInvoices.aggregates()
                }
            });
    })
    .component('gasInvoicesAggregates', GasInvoicesAggregatesComponent)
    .name;

export default GasInvoicesAggregatesModule;