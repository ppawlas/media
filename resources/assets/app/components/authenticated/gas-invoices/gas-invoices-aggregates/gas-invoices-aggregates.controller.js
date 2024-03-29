import angular from "angular";

class GasInvoicesAggregatesController {
    constructor($translate) {
        'ngInject';

        this._$translate = $translate;
    }

    $onInit() {
        this.table = {
            aggregates: angular.copy(this.aggregates)
        };

        this._$translate(['COST', 'USAGE', 'GAS_INVOICES_AGGREGATES']).then(translations => {
            let data = [
                this._getTrace('cost', translations.COST),
                this._getTrace('usage', translations.USAGE),
            ];

            this.plot = {
                data: data,
                layout: {
                    title: translations.GAS_INVOICES_AGGREGATES,
                    xaxis: {
                        fixedrange: true
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
            x: this.aggregates.map(aggregate => aggregate.year),
            y: this.aggregates.map(aggregate => aggregate[field]),
            type: 'bar',
            name: label
        }
    }
}

export default GasInvoicesAggregatesController;