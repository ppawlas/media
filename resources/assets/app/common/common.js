import angular from "angular";
import Navbar from "./navbar/navbar";
import Footer from "./footer/footer";
import Confirm from "./confirm/confirm";
import AuthService from "./auth.service";
import JWTService from "./jwt.service";
import MessagesService from "./messages.service";
import UniversalDatepicker from "./universal-datepicker/universal-datepicker";
import Formatters from "./formatters/formatters";
import Plotly from "./plotly/plotly";
import FileSaver from "file-saver";

let CommonModule = angular
    .module('app.common', [
        Navbar,
        Footer,
        Confirm,
        UniversalDatepicker,
        Formatters,
        Plotly
    ])
    .service('Auth', AuthService)
    .service('JWT', JWTService)
    .service('Messages', MessagesService)
    .factory('FileSaver', () => FileSaver)
    .name;

export default CommonModule;