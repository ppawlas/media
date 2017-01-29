import template from "./water-readings-list.html";
import controller from "./water-readings-list.controller";

let WaterReadingsListComponent = {
    restrict: 'E',
    bindings: {
        waterReadings: '<'
    },
    template,
    controller
};

export default WaterReadingsListComponent;