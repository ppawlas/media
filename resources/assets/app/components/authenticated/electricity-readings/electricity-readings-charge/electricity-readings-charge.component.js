import "./electricity-readings-charge.scss";
import template from "./electricity-readings-charge.html";
import controller from "./electricity-readings-charge.controller";

let ElectricityReadingsChargeComponent = {
    restrict: 'E',
    bindings: {
        electricityCharge: '<?'
    },
    template,
    controller
};

export default ElectricityReadingsChargeComponent;