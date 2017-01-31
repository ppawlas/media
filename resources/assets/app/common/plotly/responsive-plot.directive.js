import angular from "angular";

const ResponsivePlotDirective = (Plotly, $window) => {
    'ngInject';

    return {
        restrict: 'A',
        scope: {
            data: '<',
            layout: '<?'
        },
        link: (scope, element) => {
            let plotContainer = element[0];

            let scopeWatcher = scope.$watchGroup(['data', 'layout'], () => {
                plotContainer.data = scope.data;
                plotContainer.layout = scope.layout;
                Plotly.redraw(plotContainer);
            });

            Plotly.newPlot(plotContainer, scope.data, scope.layout);

            function onResize() {
                Plotly.Plots.resize(plotContainer);
            }

            angular.element($window).on('resize', onResize);

            scope.$on('$destroy', () => {
                scopeWatcher();
                angular.element($window).off('resize', onResize);
            });
        }
    }
};

export default ResponsivePlotDirective;