import template from "./file-input-wrapper.html";
import controller from "./file-input-wrapper.controller";

let FileInputWrapperComponent = {
    restrict: 'E',
    bindings: {
        // common bindings
        accept: '@', // accepted file type
        inputId: '@', // file input id
        // form bindings
        formName: '<?', // name of the form to which the input should belong
        fieldName: '@?', // name attribute of the form input
        // event handler
        onFileChange: '&?'
    },
    template,
    controller
};

export default FileInputWrapperComponent;