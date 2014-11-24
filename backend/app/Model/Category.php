<?php
// app/Model/Category.php
class Category extends AppModel {

	public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'category_id'
        )
    );
    
}