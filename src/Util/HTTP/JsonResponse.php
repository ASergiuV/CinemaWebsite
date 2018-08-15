<?php
/**
 * Created by PhpStorm.
 * User: sergiuabrudean
 * Date: 09.08.2018
 * Time: 16:07
 */

namespace Util\HTTP;


class JsonResponse extends Response
{

    /**
     * JsonResponse constructor.
     *
     * @param array $content
     */
    public function __construct(array $content)
    {
        parent::__construct(json_encode($content, JSON_UNESCAPED_UNICODE));
    }

    /**
     * @param string $content
     */
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }


}
