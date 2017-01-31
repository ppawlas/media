import angular from "angular";

const ResponsivePlotDirective = (Plotly, $window) => {
    'ngInject';

    return {
        restrict: 'A',
        scope: {
            data: '<'
        },
        link: (scope, element) => {
            let plotContainer = element[0];

            let dataWatcher = scope.$watch('data', () => {
                plotContainer.data = scope.data;
                Plotly.redraw(plotContainer);
            });

            Plotly.newPlot(plotContainer, scope.data);

            function onResize() {
                Plotly.Plots.resize(plotContainer);
            }

            angular.element($window).on('resize', onResize);

            scope.$on('$destroy', () => {
                dataWatcher();
                angular.element($window).off('resize', onResize);
            });
        }
    }
};

export default ResponsivePlotDirective;