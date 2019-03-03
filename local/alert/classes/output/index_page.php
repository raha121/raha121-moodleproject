<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 9/3/2018
 * Time: 12:47 PM
 */
namespace local_alert\output;

use renderable;
use renderer_base;
use templatable;
use stdClass;

class index_page implements \renderable, \templatable {
    /** @var string $sometext Some text to show how to pass data to a template. */
    var $sometext = null;

    public function __construct($sometext) {
        $this->sometext = $sometext;
    }

    /**
     * Export this data so it can be used as the context for a mustache template.
     *
     * @return stdClass
     */
    public function export_for_template(renderer_base $output) {
        $data = new stdClass();
        $data->sometext = $this->sometext;
        return $data;
    }
}