import template from "./electricity-readings-list.html";
import controller from "./electricity-readings-list.controller";

let ElectricityReadingsListComponent = {
    restrict: 'E',
    bindings: {
        electricityReadings: '<'
    },
    template,
    controller
};

export default ElectricityReadingsListComponent;