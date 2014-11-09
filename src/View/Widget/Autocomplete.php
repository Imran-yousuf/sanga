<?php
namespace App\View\Widget;

use Cake\View\Widget\WidgetInterface;
use Cake\View\Form\ContextInterface;
use Cake\Routing\Router;

class Autocomplete implements WidgetInterface {

    protected $_templates;

    public function __construct($templates) {
        $this->_templates = $templates;
    }

    public function render(array $data, ContextInterface $context) {
        $data += [
            'name' => '',
            'label' => '',
            'source' => '',
            'value' => '',
            'select' => true
        ];
        $data['source'] = ltrim($data['source'], '/');
        if($data['select']){
            return $this->_templates->format('autocompleteselect', [
                'name' => $data['name'],
                'label' => $data['label'],
                'source' => Router::url('/') . $data['source'],
                'value' => $data['val'],
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source', 'value']
                                                               )
            ]);
        }
        else{
            return $this->_templates->format('autocompletechecker', [
                'name' => $data['name'],
                'label' => $data['label'],
                'source' => Router::url('/') . $data['source'],
                'value' => $data['val'],
                'attrs' => $this->_templates->formatAttributes($data,
                                                               ['name', 'label', 'source', 'value']
                                                               )
            ]);
        }
    }
    
    public function secureFields(array $data){
       return []; 
    }
}
?>