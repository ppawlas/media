import angular from "angular";
import uiRouter from "angular-ui-router";
import GasInvoicesList from "./gas-invoices-list/gas-invoices-list";
import GasInvoiceForm from "./gas-invoice-form/gas-invoice-form";
import GasInvoicesRestoreComponent from "./gas-invoices-restore/gas-invoices-restore";
import GasInvoicesService from "./gas-invoices.service";
import GasInvoicesComponent from "./gas-invoices.component";

let GasInvoicesModule = angular
    .module('app.components.authenticated.gas-invoices', [
        uiRouter,
        GasInvoicesList,
        GasInvoiceForm,
        GasInvoicesRestoreComponent
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-invoices', {
                abstract: true,
                component: 'gasInvoices'
            });
    })
    .service('GasInvoices', GasInvoicesService)
    .component('gasInvoices', GasInvoicesComponent)
    .name;

export default GasInvoicesModule;