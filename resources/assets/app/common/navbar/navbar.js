import angular from "angular";
import uiRouter from "angular-ui-router";
import NavbarComponent from "./navbar.component";

let NavbarModule = angular
    .module('app.common.navbar', [
        uiRouter
    ])
    .component('appNavbar', NavbarComponent)
    .name;

export default NavbarModule;