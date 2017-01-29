import angular from "angular";
import MinDateDirective from "./min-date.directive";
import MaxDateDirective from "./max-date.directive";
import UniversalDatepickerComponent from "./universal-datepicker.component";

let UniversalDatepickerModule = angular
    .module('app.common.universal-datepicker', [])
    .directive('minDate', MinDateDirective)
    .directive('maxDate', MaxDateDirective)
    .component('universalDatepicker', UniversalDatepickerComponent)
    .name;

export default UniversalDatepickerModule;