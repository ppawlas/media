import angular from "angular";

class ReportPlotController {
    constructor($translate) {
        'ngInject';

        this._$translate = $translate;
    }

    $onInit() {
        this.table = {
            aggregates: angular.copy(this.aggregates)
        };

        this._$translate(['GAS_DAILY', 'ELECTRICITY_DAILY', 'WATER_WEEKLY', 'USAGE']).then(translations => {
            let data = [
                this._getTrace('gas', translations.GAS_DAILY),
                this._getTrace('electricity', translations.ELECTRICITY_DAILY),
                this._getTrace('water', translations.WATER_WEEKLY),
            ];

            this.plot = {
                data: data,
                layout: {
                    title: translations.USAGE,
                    xaxis: {
                        rangeslider: {}
                    },
                    yaxis: {
                        fixedrange: true
                    }
                }
            };
        });
    }

    _getTrace(field, label) {
        return {
            x: this.aggregates.map(aggregate => aggregate.period),
            y: this.aggregates.map(aggregate => aggregate[field]),
            type: 'scatter',
            name: label
        }
    }
}

export default ReportPlotController;