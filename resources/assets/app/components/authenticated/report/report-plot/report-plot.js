import angular from "angular";
import uiRouter from "angular-ui-router";
import ReportPlotComponent from "./report-plot.component";

let ReportPlotModule = angular
    .module('app.components.authenticated.report.plot', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.report.plot', {
                url: '/report/plot',
                component: 'reportPlot',
                resolve: {
                    aggregates: Report => Report.aggregates()
                }
            });
    })
    .component('reportPlot', ReportPlotComponent)
    .name;

export default ReportPlotModule;