import angular from "angular";
import uiRouter from "angular-ui-router";
import BackupService from "./backup.service";
import BackupComponent from "./backup.component";

let BackupModule = angular
    .module('app.components.authenticated.backup', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticated.backup', {
                url: '/backup',
                component: 'backup'
            });
    })
    .service('Backup', BackupService)
    .component('backup', BackupComponent)
    .name;

export default BackupModule;