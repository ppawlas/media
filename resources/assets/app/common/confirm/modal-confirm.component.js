import template from "./modal-confirm.template.html";
import controller from "./modal-confirm.controller";

let ModalConfirmComponent = {
    restrict: 'E',
    bindings: {
        resolve: '<',
        close: '&',
        dismiss: '&'
    },
    template,
    controller
};

export default ModalConfirmComponent;