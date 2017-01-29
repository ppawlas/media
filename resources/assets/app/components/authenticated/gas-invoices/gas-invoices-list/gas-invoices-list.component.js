import template from "./gas-invoices-list.html";
import controller from "./gas-invoices-list.controller";

let GasInvoicesListComponent = {
    restrict: 'E',
    bindings: {
        gasInvoices: '<'
    },
    template,
    controller
};

export default GasInvoicesListComponent;