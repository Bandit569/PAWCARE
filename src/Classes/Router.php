<?php


namespace Classes;

require_once(dirname(__FILE__)."/Exceptions/MultipleRouteFoundException.php");
require_once(dirname(__FILE__)."/Exceptions/NoRouteFoundException.php");

use Classes\Exceptions\MultipleRouteFoundException;/**
 * Class MultipleRouteFoundException
 *
 * Exception thrown when multiple routes.json are found for a given request when only one was expected.
 * This exception typically indicates a configuration or routing error where the routing logic is
 * ambiguous or improperly defined.

 */

    use Classes\Exceptions\NoRouteFoundException;/**
 * Class NoRouteFoundException
 *
 * This exception is thrown when the requested route cannot be found within the routing table.
 * It indicates that the URL requested by the client does not match any defined route in the
 * application's routing configuration.
 */


/**
 * The Router class is responsible for managing and finding routes.json.
 * It loads the route definitions from a JSON file and matches incoming HTTP requests to the appropriate route.
 */
class Router
{
    /**
     *
     */
    private mixed $listRoute;

    /**
     * Constructs a new instance and initializes the listRoute property
     * by reading and decoding the routes.json configuration file.
     *
     * @return void
     */
    public function __construct()
    {
        $stringRoute = file_get_contents(dirname(__DIR__) . "/Config/routes.json");
        $this->listRoute = json_decode($stringRoute);
    }

    /**
     * Finds the matching route based on the HTTP request.
     *
     * @param HttpRequest $httpRequest The HTTP request to find the route for.
     * @return Route The found route object, or a string if multiple routes.json or no routes.json are found.
     * @throws MultipleRouteFoundException If more than one matching route is found.
     * @throws NoRouteFoundException If no matching route is found.
     */
    public function findRoute(HttpRequest $httpRequest): Route
    {
        $routeFound = array_filter($this->listRoute,function($route) use ($httpRequest){
            echo $route->method . $httpRequest->getMethod();
            return preg_match("#^/PAWCARE" . $route->path . "$#", $httpRequest->getUrl()) && $route->method == $httpRequest->getMethod();


        });
        $numRoute = count($routeFound);
        if($numRoute > 1){
            throw new MultipleRouteFoundException();
        }
        else if($numRoute == 0){
            throw new NoRouteFoundException();
        }
        else{
            $matchedroute = reset($routeFound);
            return new Route($matchedroute);
        }
    }
}