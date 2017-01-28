import authInterceptor from "./auth.interceptor";
import PLTranslations from "./pl.translations";
import blockUITemplate from "./block.ui.template.html";

function AppConfig($httpProvider,
                   $stateProvider,
                   $urlRouterProvider,
                   $translateProvider,
                   blockUIConfig,
                   NotificationProvider) {
    'ngInject';

    // push interceptor for auth
    $httpProvider.interceptors.push(authInterceptor);

    // set main abstract state
    $stateProvider
        .state('app', {
            abstract: true,
            component: 'app',
            resolve: {
                authentication: (Auth) => Auth.verifyAuth()
            }
        });

    // set default route
    $urlRouterProvider.otherwise('/authenticate');

    // set translations
    $translateProvider
        .translations('pl', PLTranslations)
        .preferredLanguage('pl');
    // enable escaping of HTML
    $translateProvider.useSanitizeValueStrategy('escape');

    // set the block ui config
    blockUIConfig.message = 'LOADING';
    blockUIConfig.template = blockUITemplate;

    // set ui notification config
    NotificationProvider.setOptions({
        delay: 10000,
        positionX: 'right',
        positionY: 'bottom'
    });
}

export default AppConfig;