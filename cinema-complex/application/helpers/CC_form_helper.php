<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Always check if the function exists first.
if (!function_exists('custom_form_input'))
{
    function custom_form_input($label = '', $data = '', $value = '', $extra = '')
    {
        // check if $data is an array, if not, make it one.
        is_array($data) OR $data = ['name' => $data];

        // create an ID if one wasn't given.
        array_key_exists('id', $data) OR $data['id'] = uniqid();

        $output = '<div class="form-group row">';
        $output .= form_label($label, $data['id'], ['class' => 'col-sm-2 col-form-label']);
        $output .= '<div class="col-10">';
        $output .= form_input($data, $value, $extra);
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }
}

if ( ! function_exists('form_dropdown'))
{
	/**
	 * Drop-down Menu
	 *
	 * @param	mixed	$data
	 * @param	mixed	$options
	 * @param	mixed	$selected
	 * @param	mixed	$extra
	 * @return	string
	 */
	function custom_form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
	{
		$defaults = array();

		if (is_array($data))
		{
			if (isset($data['selected']))
			{
				$selected = $data['selected'];
				unset($data['selected']); // select tags don't have a selected attribute
			}

			if (isset($data['options']))
			{
				$options = $data['options'];
				unset($data['options']); // select tags don't use an options attribute
			}
		}
		else
		{
			$defaults = array('name' => $data);
		}

		is_array($selected) OR $selected = array($selected);
		is_array($options) OR $options = array($options);

		// If no selected state was submitted we will attempt to set it automatically
		if (empty($selected))
		{
			if (is_array($data))
			{
				if (isset($data['name'], $_POST[$data['name']]))
				{
					$selected = array($_POST[$data['name']]);
				}
			}
			elseif (isset($_POST[$data]))
			{
				$selected = array($_POST[$data]);
			}
		}

		$extra = _attributes_to_string($extra);

		$multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

		$form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";


		foreach ($options as $key => $val)
		{
			$key = (string) $key;

			if (is_array($val))
			{
				if (empty($val))
				{
					continue;
				}

				$form .= '<optgroup label="'.$key."\">\n";

				foreach ($val as $optgroup_key => $optgroup_val)
				{
					$sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
					$form .= '<option value="'.html_escape($optgroup_key).'"'.$sel.'>'
						.(string) $optgroup_val."</option>\n";
				}

				$form .= "</optgroup>\n";
			}
			else
			{
				$form .= '<option value="'.html_escape($key).'"'
					.(in_array($key, $selected) ? ' selected="selected"' : '').'>'
					.(string) $val."</option>\n";
			}
		}

		return $form."</select>\n";
	}
}

if (!function_exists('custom_form_upload'))
{
    function custom_form_upload($label = '', $data = '', $value = '', $extra = '')
    {
        // check if $data is an array, if not, make it one.
        is_array($data) OR $data = ['name' => $data];

        // create an ID if one wasn't given.
        array_key_exists('id', $data) OR $data['id'] = uniqid();

        // create a class if one wasn't specified.
        array_key_exists('class', $data) OR $data['class'] = '';
        $data['class'] .= ' custom-file-input';

        $output = '<div class="custom-file">';
        $output .= form_upload($data, $value, $extra);

        if (empty($label)) $label = 'Choose File';
        $output .= form_label($label, $data['id'], ['class' => 'custom-file-label']);
        $output .= '</div>';

        return $output;
    }
}
