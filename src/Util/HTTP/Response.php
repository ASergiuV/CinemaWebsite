<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 09.08.2018
 * Time: 16:06
 */

namespace Util\HTTP;


class Response
{

    protected $content;

    /**
     * Response constructor.
     *
     * @param $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }


    /**
     * @param string $content
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }


}
