import angular from "angular";

class GasInvoicesAggregatesController {
    constructor($translate, Plotly) {
        'ngInject';

        this._Plotly = Plotly;
        this._$translate = $translate;
    }

    $onInit() {
        this.table = {
            aggregates: angular.copy(this.aggregates)
        };

        this._$translate(['COST', 'USAGE']).then(translations => {
            let data = [
                this._getTrace('cost', translations.COST),
                this._getTrace('usage', translations.USAGE),
            ];

            this._Plotly.newPlot('aggregatesPlot', data);
        });
    }

    _getTrace(field, label) {
        return {
            x: this.aggregates.map(aggregate => aggregate.year),
            y: this.aggregates.map(aggregate => aggregate[field]),
            type: 'bar',
            name: label
        }
    }
}

export default GasInvoicesAggregatesController;