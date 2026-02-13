<?php

if (!function_exists('isActiveRoute')) {
  /**
   * Return 'active' if the current route matches one or more route names
   *
   * @param string|array $routeNames
   * @return string
   */
  function isActiveRoute($routeNames)
  {
    $routeNames = is_array($routeNames) ? $routeNames : [$routeNames];

    foreach ($routeNames as $name) {
      if (request()->routeIs($name)) {
        return 'active';
      }
    }

    return '';
  }
}
