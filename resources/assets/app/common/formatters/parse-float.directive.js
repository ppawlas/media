const ParseFloatDirective = () => {
    return {
        require: 'ngModel',
        restrict: 'A',
        link($scope, $element, $attrs, ngModel) {
            ngModel.$formatters.push(function (value) {
                return parseFloat(value);
            });
        }
    }
};

export default  ParseFloatDirective;