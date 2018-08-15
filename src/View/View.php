<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 09.08.2018
 * Time: 16:05
 */

namespace View;


class View
{
    /**
     * @param $path
     * @param $arguments
     *
     * @return string
     * @throws \Exception
     */
    public static function render($path, $arguments = [])
    {
        extract($arguments);

        ob_start();
        //require_once 'web-src/header.html';
        require_once $path;
        //require_once 'web-src/footer.html';
        $output = ob_get_contents();
        ob_end_clean();

        return $output;
    }

}

