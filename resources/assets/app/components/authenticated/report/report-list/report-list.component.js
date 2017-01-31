import template from "./report-list.html";
import controller from "./report-list.controller";

let ReportListComponent = {
    restrict: 'E',
    bindings: {
        aggregates: '<'
    },
    template,
    controller
};

export default ReportListComponent;