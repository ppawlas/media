import angular from "angular";
import uiRouter from "angular-ui-router";
import ReportList from "./report-list/report-list";
import ReportPlot from "./report-plot/report-plot";
import ReportService from "./report.service";
import ReportComponent from "./report.component";

let ReportModule = angular
    .module('app.components.authenticated.report', [
        uiRouter,
        ReportList,
        ReportPlot
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.report', {
                abstract: true,
                component: 'report'
            });
    })
    .service('Report', ReportService)
    .component('report', ReportComponent)
    .name;

export default ReportModule;