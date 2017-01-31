import template from "./report-plot.html";
import controller from "./report-plot.controller";

let ReportPlotComponent = {
    restrict: 'E',
    bindings: {
        aggregates: '<'
    },
    template,
    controller
};

export default ReportPlotComponent;