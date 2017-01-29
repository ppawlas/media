import "./gas-reading-form.scss";
import template from "./gas-reading-form.html";
import controller from "./gas-reading-form.controller";

let GasReadingFormComponent = {
    restrict: 'E',
    bindings: {
        gasReading: '<?'
    },
    template,
    controller
};

export default GasReadingFormComponent;