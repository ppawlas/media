import angular from "angular";
import uiBootstrap from "angular-ui-bootstrap";
import ModalConfirmComponent from "./modal-confirm.component";
import ConfirmDirective from "./confirm.directive";

let ConfirmModule = angular
    .module('app.commons.confirm', [
        uiBootstrap
    ])
    .component('modalConfirm', ModalConfirmComponent)
    .directive('confirm', ConfirmDirective)
    .name;

export default ConfirmModule;