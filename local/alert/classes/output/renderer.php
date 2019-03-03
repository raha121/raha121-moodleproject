<?php
/**
 * Created by PhpStorm.
 * User: Raha121
 * Date: 9/3/2018
 * Time: 12:48 PM
 */

// Standard GPL and phpdocs
namespace local_alert\output;

defined('MOODLE_INTERNAL') || die;

//use plugin_renderer_base;

class renderer extends \plugin_renderer_base {
    /**
     * Defer to template.
     *
     * @param index_page $page
     *
     * @return string html for the page
     */
    public function render_index_page(\templatable $page) {

        $data = $page->export_for_template($this);

        return $this-> render_from_template('local_alert/index_page',$data);

//        return parent::render_from_template('local_alert/index_page', $data);
    }
}