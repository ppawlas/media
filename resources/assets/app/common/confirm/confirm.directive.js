const ConfirmDirective = ($uibModal) => {
    'ngInject';

    return {
        priority: 1,
        restrict: 'A',
        scope: {
            confirmIf: '=',
            ngClick: '&',
        },
        link($scope, $element, $attrs) {
            // unbind any other click event bindings from the element
            $element.unbind('click').bind('click', ($event) => {
                // prevent default action
                $event.preventDefault();

                // if there is a modal condition check it
                if ($scope.confirmIf === undefined || $scope.confirmIf) {
                    // create the modal instance
                    let modalInstance = $uibModal.open({
                        component: 'modalConfirm',
                        resolve: {
                            message: ($q) => {
                                let deferred = $q.defer();
                                deferred.resolve($attrs.confirm); // set the confirm message
                                return deferred.promise;
                            }
                        }
                    });
                    // resolve action when modal is closed
                    modalInstance.result.then(
                        () => {
                            // fire the actual click event on confirm
                            if ($scope.ngClick) {
                                $scope.ngClick();
                            }
                        },
                        () => {
                            // no action on cancel
                        }
                    );
                } else {
                    // fire the actual click event
                    if ($scope.ngClick) {
                        $scope.ngClick();
                    }
                }
            });
        }
    }
};

export default ConfirmDirective;