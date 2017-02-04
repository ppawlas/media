class ElectricityReadingsPredictionController {
    constructor(ElectricityReadings, Messages) {
        'ngInject';

        this._Messages = Messages;
        this._ElectricityReadings = ElectricityReadings;
    }

    $onInit() {
        this.initialDate = this._getYearFirstDay();
        this.prediction = {};

        this.getPrediction();
    }

    setInitialDate($event) {
        this.initialDate = $event.dt;
    }

    getPrediction() {
        this._ElectricityReadings.getPrediction({'initial_date': this.initialDate}).then(
            res => {
                this.prediction = res;
                this.prediction.initialDate = new Date(this.initialDate);
                this._Messages.showMessage('PREDICTION_CALCULATED', 'success');
            },
            err => {
                this._Messages.showMessage('PREDICTION_CALCULATE_ERROR', 'error');
            }
        );
    }

    _getYearFirstDay() {
        let date = new Date();
        date.setMilliseconds(0);
        date.setSeconds(0);
        date.setMinutes(0);
        date.setHours(0);
        date.setDate(1);
        date.setMonth(0);

        return date;
    }
}

export default ElectricityReadingsPredictionController;