<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Moodle Plugin
 *
 * Index file
 *
 * @package    local
 * @subpackage flow_chart
 * @copyright  2014, LearningWorks Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(dirname(dirname(__FILE__))).'/config.php');
require_once(dirname(__FILE__).'/lib.php');

global $PAGE, $CFG;

// Set page variables.
$PAGE->set_url('/local/flow_chart/view.php');
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Induction');
$PAGE->navbar->add('Induction');

$PAGE->requires->jquery();
$PAGE->requires->js(new moodle_url($CFG->wwwroot . '/local/flow_chart/js/scripts.js') );
$PAGE->requires->js(new moodle_url($CFG->webroot . '/local/flow_chart/styles.js'));

echo $OUTPUT->header();

$question_count = 1;

?>

<div class="module module-flow_chart">
	<h1>THE CORRECT INDUCTION FOR YOU</h1>
	<h3>Answer all of the questions below, new questions will appear once you have answered the previous one, and then click the 'Submit Answers' button when it appears at the bottom of the page.</h3>
	<form id="flow_chart">
		<fieldset id="question_1" class="flow_chart-question">
		</fieldset>
	</form>
</div>

<?php


echo $OUTPUT->footer();
