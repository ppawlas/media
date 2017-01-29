import angular from "angular";
import Navbar from "./navbar/navbar";
import Footer from "./footer/footer";
import Confirm from "./confirm/confirm";
import AuthService from "./auth.service";
import JWTService from "./jwt.service";
import MessagesService from "./messages.service";
import UniversalDatepicker from "./universal-datepicker/universal-datepicker";
import Formatters from "./formatters/formatters";

let CommonModule = angular
    .module('app.common', [
        Navbar,
        Footer,
        Confirm,
        UniversalDatepicker,
        Formatters
    ])
    .service('Auth', AuthService)
    .service('JWT', JWTService)
    .service('Messages', MessagesService)
    .name;

export default CommonModule;