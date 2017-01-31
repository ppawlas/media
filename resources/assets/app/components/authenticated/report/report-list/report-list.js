import angular from "angular";
import uiRouter from "angular-ui-router";
import ReportListComponent from "./report-list.component";

let ReportListModule = angular
    .module('app.components.authenticated.report.list', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.report.list', {
                url: '/report/list',
                component: 'reportList',
                resolve: {
                    aggregates: Report => Report.aggregates()
                }
            });
    })
    .component('reportList', ReportListComponent)
    .name;

export default ReportListModule;