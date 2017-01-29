import "bootstrap/dist/css/bootstrap.css";
import "font-awesome/css/font-awesome.css";
import "ui-select/dist/select.css";
import "angular-block-ui/dist/angular-block-ui.css";
import "angular-ui-notification/dist/angular-ui-notification.css";
import angular from "angular";
import uiRouter from "angular-ui-router";
import uiBootstrap from "angular-ui-bootstrap";
import uiSelect from "ui-select";
import uiNotification from "angular-ui-notification";
import ngMessages from "angular-messages";
import ngAnimate from "angular-animate";
import ngSanitize from "angular-sanitize";
import ngTranslate from "angular-translate";
import ngSmartTable from "angular-smart-table";
import blockUI from "angular-block-ui";
import dirPagination from "angular-utils-pagination";
import ngFileUpload from "ng-file-upload";
import AppConfig from "./config/app.config";
import AppRun from "./config/app.run";
import AppConstants from "./config/app.constants";
import Common from "./common/common";
import Components from "./components/components";
import AppComponent from "./app.component";
require("imports-loader?angular=angular!angular-i18n/angular-locale_pl-pl");
require("imports-loader?angular=angular!angular-ui-bootstrap/dist/ui-bootstrap-tpls");

angular
    .module('app', [
        uiRouter,
        uiBootstrap,
        uiSelect,
        uiNotification,
        ngMessages,
        ngAnimate,
        ngSanitize,
        ngTranslate,
        ngSmartTable,
        blockUI,
        dirPagination,
        ngFileUpload,
        Common,
        Components
    ])
    .config(AppConfig)
    .run(AppRun)
    .component('app', AppComponent)
    .constant('AppConstants', AppConstants);