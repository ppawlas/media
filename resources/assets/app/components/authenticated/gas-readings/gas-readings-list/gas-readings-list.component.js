import template from "./gas-readings-list.html";
import controller from "./gas-readings-list.controller";

let GasReadingsListComponent = {
    restrict: 'E',
    bindings: {
        gasReadings: '<'
    },
    template,
    controller
};

export default GasReadingsListComponent;