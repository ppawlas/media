import angular from "angular";

class ReportListController {
    $onInit() {
        this.table = {
            aggregates: angular.copy(this.aggregates)
        };
    }
}

export default ReportListController;