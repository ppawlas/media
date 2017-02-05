import angular from "angular";
import FileInputWrapperComponent from "./file-input-wrapper.component";

let FileInputWrapperModule = angular
    .module('app.common.file-input-wrapper', [])
    .component('fileInputWrapper', FileInputWrapperComponent)
    .name;

export default FileInputWrapperModule;