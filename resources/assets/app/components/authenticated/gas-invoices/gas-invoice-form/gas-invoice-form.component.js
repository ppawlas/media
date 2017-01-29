import "./gas-invoice-form.scss";
import template from "./gas-invoice-form.html";
import controller from "./gas-invoice-form.controller";

let GasInvoiceFormComponent = {
    restrict: 'E',
    bindings: {
        gasInvoice: '<?'
    },
    template,
    controller
};

export default GasInvoiceFormComponent;