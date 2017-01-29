class UniversalDatepickerController {
    constructor($filter) {
        'ngInject';

        this._$filter = $filter;
    }

    $onInit() {
        this.opened = false; // closed by default
        this.format = 'yyyy-MM-dd'; // default format
        this.dateOptions = {
            startingDay: 1,
            dateDisabled: (data) => {
                let date = data.date;
                let mode = data.mode;
                return mode === 'day' && (date.getDay() === 0 || date.getDay() === 6);
            }
        };
        this.modelOptions = {
            allowInvalid: true // persist the model value even if it is an invalid date
        };

        // if not specified explicitly, datetime is trimmed to date only
        if (this.noTime === undefined) {
            this.noTime = true;
        }
    }

    $onChanges(changes) {
        if (changes.dt) {
            // if the new datetime is string, convert it to the date object
            if (typeof this.dt === 'string') {
                this.dt = new Date(this.dt);
            }
            // if datetime is defined and should be trimmed to the date only
            if (this.dt && this.noTime) {
                // clear the time part
                this.dt.setMilliseconds(0);
                this.dt.setSeconds(0);
                this.dt.setMinutes(0);
                this.dt.setHours(0);
            }
        }

        // at the end of each change if the component is defined in the form context, enforce validation
        if (this.getFormField() && this.getFormField().$validators) {
            this.getFormField().$validate();
        }
    }

    /**
     * Open the datepicker popup.
     */
    open() {
        this.opened = true;
    }

    /**
     * Get the object defining field in the form context.
     * If component is not defined in the form context, returns empty object.
     * @returns {*}
     */
    getFormField() {
        if (this.formName && this.fieldName) {
            return this.formName[this.fieldName];
        } else {
            return {};
        }
    }

    /**
     * After each change, if there is an event handler defined, emmit new event containing datetime object.
     */
    onChange() {
        if (this.onDtChange) {
            this.onDtChange({
                $event: {
                    dt: this._$filter('date')(this.dt, 'yyyy-MM-dd HH:mm:ss')
                }
            });
        }
    }
}

export default UniversalDatepickerController;
