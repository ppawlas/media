const MinDateDirective = () => {
    return {
        require: 'ngModel',
        link(scope, elm, attrs, ctrl) {
            ctrl.$validators.minDate = (modelValue, viewValue) => {
                let minDate = new Date(attrs.minDate.replace(/"/g, ''));

                if (ctrl.$isEmpty(modelValue)) {
                    // consider empty models to be valid
                    return true;
                } else if (isNaN(minDate.getTime())) {
                    // consider model to be valid if attribute is not a valid date
                    return true;
                } else {
                    // consider model equal to the min date to be still valid
                    return modelValue >= minDate;
                }
            }
        }
    }
};

export default MinDateDirective;