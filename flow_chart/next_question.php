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

	$question = (int) $_POST['question']; // Represents next question via integer.

	$data = array();

	// Next question type.
	$data['type'] = get_config('local_flow_chart', 'question_type_' . $question);
	

	if ($data['type'] == 'Leaf') {
		$data['responce'] = get_config('local_flow_chart', 'question_' . $question . '_responce');
	} else if ($data['type'] == 'Branch') {
		// Next question.
		$data['question'] = get_config('local_flow_chart', 'question_' . $question . '_info');

		// Next answer one.
		$data['answer_1'] = get_config('local_flow_chart', 'question_' . $question . '_ans_1');

		// Next answer two.
		$data['answer_2'] = get_config('local_flow_chart', 'question_' . $question . '_ans_2');

		// Links.
		$data['link_1'] = get_config('local_flow_chart', 'link_' . $question . '_ans_1');
		$data['link_2'] = get_config('local_flow_chart', 'link_' . $question . '_ans_2');
	} else {
		// Error.
	}

	// Send data back to the script;
	echo json_encode($data);
?>