import angular from "angular";
import Plotly from "./plotly.factory";

let PlotlyModule = angular
    .module('app.common.plotly', [])
    .factory('Plotly', Plotly.factory)
    .name;

export default PlotlyModule;