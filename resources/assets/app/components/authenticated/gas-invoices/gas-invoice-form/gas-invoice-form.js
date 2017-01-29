import angular from "angular";
import uiRouter from "angular-ui-router";
import GasInvoiceFormComponent from "./gas-invoice-form.component";

let GasInvoiceFormModule = angular
    .module('app.components.authenticated.gas-invoices.form', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.gas-invoices.create', {
                url: '/gas-invoices/create',
                component: 'gasInvoiceForm'
            })
            .state('app.authenticated.gas-invoices.edit', {
                url: '/gas-invoices/edit/:id',
                component: 'gasInvoiceForm',
                resolve: {
                    gasInvoice: (GasInvoices, $stateParams) => GasInvoices.show($stateParams.id)
                }
            });
    })
    .component('gasInvoiceForm', GasInvoiceFormComponent)
    .name;

export default GasInvoiceFormModule;