import angular from "angular";

class GasInvoicesAggregatesController {
    $onInit() {
        this.table = {
            aggregates: angular.copy(this.aggregates)
        }
    }
}

export default GasInvoicesAggregatesController;