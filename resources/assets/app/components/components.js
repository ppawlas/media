import angular from "angular";
import Authenticate from "./authenticate/authenticate";
import Authenticated from "./authenticated/authenticated";

let ComponentsModule = angular
    .module('app.components', [
        Authenticate,
        Authenticated
    ])
    .name;

export default ComponentsModule;