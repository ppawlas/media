import template from "./universal-datepicker.html";
import controller from "./universal-datepicker.controller";

let UniversalDatepickerComponent = {
    restrict: 'E',
    bindings: {
        // common bindings
        dt: '<?', // datetime
        noTime: '<?', // trim datetime to date only
        disabled: '<?', // disable input and button
        // form bindings
        formName: '<?', // name of the form to which the input should belong
        fieldName: '@?', // name attribute of the form input
        fieldLabel: '@?', // input label
        // constraints
        required: '<?',
        minDt: '<?',
        maxDt: '<?',
        // additional message labels
        minDtLabel: '@?',
        maxDtLabel: '@?',
        // event handler
        onDtChange: '&?'
    },
    template,
    controller
};

export default UniversalDatepickerComponent;