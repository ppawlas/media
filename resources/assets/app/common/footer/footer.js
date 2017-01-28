import angular from "angular";
import FooterComponent from "./footer.component";

let FooterModule = angular
    .module('app.common.footer', [])
    .component('appFooter', FooterComponent)
    .name;

export default FooterModule;