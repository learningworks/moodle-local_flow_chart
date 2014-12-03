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
 * Settings
 *
 * @package    local
 * @subpackage flow_chart
 * @copyright  2014, LearningWorks Ltd
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once(dirname(__FILE__).'/lib.php');

if ($hassiteconfig) {
    global $CFG, $USER, $DB;

    $settings = new admin_settingpage('local_flow_chart', get_string('pluginname', 'local_flow_chart'));
    $ADMIN->add('localplugins', $settings);

    
    $settings->add(
        new admin_setting_configselect(
           'local_flow_chart/num_questions', // name.
           get_string('num_questions', 'local_flow_chart'), // title.
           '', // description.
           '5', // default.
           array( // options.
           		1 => '1',
        		2 => '2',
        		3 => '3',
        		4 => '4',
        		5 => '5',
        		6 => '6',
        		7 => '7',
        		8 => '8',
        		9 => '9',
        		10 => '10',
        		11 => '11',
        		12 => '12',
        		13 => '13',
        		14 => '14',
        		15 => '15'
           	)
        )
    );
    
    $num_questions = get_config('local_flow_chart', 'num_questions');
    for ($i = 1; $i <= $num_questions; $i++) {

        // Number of Questions Heading
        $settings->add(
        new admin_setting_heading(
            'local_flow_chart/question_section_' . $i, // name.
            get_string('question_section', 'local_flow_chart') . ' ' . $i, // title.
            '') // description.
        );


        // Question Type Selection.
        $settings->add(
            new admin_setting_configselect(
                'local_flow_chart/question_type_' . $i, // name.
                get_string('question_type', 'local_flow_chart'), // title.
                get_string('question_type_desc', 'local_flow_chart'), // description.
                'Branch', // default.
                array( // options.
                    'Branch' => 'Branch',
                    'Leaf' => 'Leaf',
                )
            )
        );

        // If it's a branch type question, generate branch question fields.
        if (get_config('local_flow_chart', 'question_type_'. $i) == 'Branch') {
            
            // Question
            $settings->add(
                new admin_setting_confightmleditor(
                    'local_flow_chart/question_' . $i . '_info', // name.
                    'Question', // title.
                    '', // description/
                    ''// default.
                )
            );

            // Possible Answer 1
            $settings->add(
                new admin_setting_configtext(
                    'local_flow_chart/question_' . $i . '_ans_1', // name.
                    'Answer 1', // title.
                    '', // description
                    ''// default.
                )
            );

            // Link 1
            $settings->add(
                new admin_setting_configselect(
                   'local_flow_chart/link_' . $i . '_ans_1', // name.
                   'Link 1', // title.
                   '', // description.
                   '5', // default.
                   flow_chart_generate_link_array($num_questions) // options.
                )
            );

            // Possible Answer 2
            $settings->add(
                new admin_setting_configtext(
                    'local_flow_chart/question_' . $i . '_ans_2', // name.
                    'Answer 2', // title.
                    '', // description/
                    ''// default.
                )
            );

            // Link 2
            $settings->add(
                new admin_setting_configselect(
                   'local_flow_chart/link_' . $i . '_ans_2', // name.
                   'Link 2', // title.
                   '', // description.
                   '5', // default.
                   flow_chart_generate_link_array($num_questions) // options.
                )
            );
        }
        // If it's a leaf type question, generate branch question fields.
        else {
            // Responce
            $settings->add(
                new admin_setting_confightmleditor(
                    'local_flow_chart/question_' . $i . '_responce', // name.
                    'Responce', // title.
                    '', // description
                    ''// default.
                )
            );
        }
    }

    $CFG->additionalhtmlfooter .= '<script src="'.$CFG->wwwroot .'/local/flow_chart/js/jquery-2.1.1.min.js"></script>';
    $CFG->additionalhtmlfooter .= '<script src="'.$CFG->wwwroot .'/local/flow_chart/js/scripts.js"></script>';
    $CFG->additionalhtmlfooter .= '<script>addReloadClass(' . $num_questions . ');attachReloadHandler();</script>';
}