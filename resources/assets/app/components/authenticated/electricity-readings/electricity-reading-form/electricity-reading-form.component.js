import "./electricity-reading-form.scss";
import template from "./electricity-reading-form.html";
import controller from "./electricity-reading-form.controller";

let ElectricityReadingFormComponent = {
    restrict: 'E',
    bindings: {
        electricityReading: '<?'
    },
    template,
    controller
};

export default ElectricityReadingFormComponent;