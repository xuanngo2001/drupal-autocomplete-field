<?php
namespace Drupal\tradesteps\Controller;
 
use Drupal\Core\Controller\ControllerBase;

// Use for autocomplete.
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Autocomplete extends ControllerBase {

    public function handleAutocomplete(Request $request) {
        $matches = array();
        
        // Get the string that is being typed.
        $string = $request->query->get('q');
        
        if ($string) {
            // Search in database.
            $query = \Drupal::entityQuery('node')
                                    ->condition('status', 1)
                                    ->condition('title', '%'.db_like($string).'%', 'LIKE');
            $nids = $query->execute();
            $result = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($nids);
            
            // Format results found as json.
            foreach ($result as $row) {
                $matches[] = ['value' => $row->nid->value, 'label' => $row->title->value];
            }
        }
        return new JsonResponse($matches);
    }
}
