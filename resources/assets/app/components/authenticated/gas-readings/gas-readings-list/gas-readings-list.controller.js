import angular from "angular";

class GasReadingsListController {
    constructor(GasReadings, Messages) {
        'ngInject';

        this._Messages = Messages;
        this._GasReadings = GasReadings;
    }

    $onInit() {
        this.table = {
            gasReadings: angular.copy(this.gasReadings)
        }
    }

    destroy(id) {
        this._GasReadings.destroy(id).then(
            res => {
                this._Messages.showMessage('READING_DELETED', 'success');
                this._GasReadings.index().then(res => this.gasReadings = res);
            },
            err => {
                this._Messages.showMessage('READING_DELETE_ERROR', 'error');
            }
        );
    }

    dump() {
        this._GasReadings.dump().then(
            res => {
                this._Messages.showMessage('DATA_EXPORTED', 'success');
            },
            err => {
                this._Messages.showMessage('DATA_EXPORT_ERROR', 'error');
            }
        )
    }
}

export default GasReadingsListController;