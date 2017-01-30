import template from "./gas-invoices-aggregates.html";
import controller from "./gas-invoices-aggregates.controller";

let GasInvoicesAggregatesComponent = {
    restrict: 'E',
    bindings: {
        aggregates: '<'
    },
    template,
    controller
};

export default GasInvoicesAggregatesComponent;