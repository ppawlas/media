import angular from "angular";
import uiRouter from "angular-ui-router";
import AuthenticateComponent from "./authenticate.component";

let AuthenticateModule = angular
    .module('app.components.authenticate', [
        uiRouter
    ])
    .config(($stateProvider) => {
        'ngInject';

        $stateProvider
            .state('app.authenticate', {
                url: '/authenticate',
                component: 'authenticate',
                resolve: {
                    notAuthenticated: ($q, $state, Auth) => {
                        let deferred = $q.defer();

                        Auth.verifyAuth().then((authenticated) => {
                            if (authenticated) {
                                // redirect to the dashboard
                                $state.go('app.authenticated.dashboard', {}, {reload: true});
                                deferred.resolve(false);
                            } else {
                                deferred.resolve(true);
                            }
                        });
                    }
                }
            })
    })
    .component('authenticate', AuthenticateComponent)
    .name;

export default AuthenticateModule;