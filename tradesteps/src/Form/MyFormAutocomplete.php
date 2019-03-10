<?php
namespace Drupal\tradesteps\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class MyFormAutocomplete extends FormBase {

    public function buildForm(array $form, FormStateInterface $form_state) {

        // Add autocomplete routing to turn your field into an autocomplete field.
        $form['title'] = [
                            '#type' => 'textfield',
                            '#title' => $this->t('Title'),
                            '#autocomplete_route_name' => 'tradesteps.autocomplete_field',
                        ];

        return $form;
    }

    public function getFormId() {
        return 'tradesteps_autocompleteform';
    }
    
    public function submitForm(array &$form, FormStateInterface $form_state) {
    }

}