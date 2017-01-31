import angular from "angular";
import Plotly from "./plotly.factory";
import ResponsivePlotDirective from "./responsive-plot.directive";

let PlotlyModule = angular
    .module('app.common.plotly', [])
    .factory('Plotly', Plotly.factory)
    .directive('responsivePlot', ResponsivePlotDirective)
    .name;

export default PlotlyModule;