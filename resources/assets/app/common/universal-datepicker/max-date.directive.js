const MaxDateDirective = () => {
    return {
        require: 'ngModel',
        link(scope, element, attrs, ctrl) {
            ctrl.$validators.maxDate = (modelValue, viewValue) => {
                let maxDate = new Date(attrs.maxDate.replace(/"/g, ''));

                if (ctrl.$isEmpty(modelValue)) {
                    // consider empty models to be valid
                    return true;
                } else if (isNaN(maxDate.getTime())) {
                    // consider model to be valid if attribute is not a valid date
                    return true;
                } else {
                    // consider model equal to the max date to be still valid
                    return modelValue <= maxDate;
                }
            }
        }
    }
};

export default MaxDateDirective;