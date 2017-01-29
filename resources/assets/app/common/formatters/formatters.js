import angular from "angular";
import ParseFloatDirective from "./parse-float.directive";

let FormattersModule = angular
    .module('app.common.formatters', [])
    .directive('parseFloat', ParseFloatDirective)
    .name;

export default FormattersModule;