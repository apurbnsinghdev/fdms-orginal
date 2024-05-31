<?php
/*
|--------------------------------------------------------------------------
| Delete form macro
|--------------------------------------------------------------------------
|
| This macro creates a form with only a submit button.
| We'll use it to generate forms that will post to a certain url with the DELETE method,
| following REST principles.
|
 */
Form::macro('delete', function ($url, $button_label = NULL, $form_parameters = array(), $button_options = array()) {

	if (!$button_label) {
		$button_label = '<span aria-hidden="true" class="fa fa-remove"></span>';
	}

	if (count($button_options) > 0) {
		$button_options['type'] = 'submit';
	} else {
		$button_options['type'] = 'submit';
		$button_options['class'] = 'btn btn-xs';
	}

	if (empty($form_parameters)) {
		$form_parameters['url'] = $url;
		$form_parameters['method'] = 'DELETE';
		$form_parameters['class'] = 'delete-form';
	} else {
		$form_parameters['url'] = $url;
		$form_parameters['method'] = 'DELETE';
	};

	return Form::open($form_parameters)
	. Form::button($button_label, $button_options)
	. Form::close();
});

?>