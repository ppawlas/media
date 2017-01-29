import "./water-reading-form.scss";
import template from "./water-reading-form.html";
import controller from "./water-reading-form.controller";

let WaterReadingFormComponent = {
    restrict: 'E',
    bindings: {
        waterReading: '<?'
    },
    template,
    controller
};

export default WaterReadingFormComponent;