<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


/**
 * Student model
 *
 * @package students
 * @subpackage students.models
 */

class Percentile extends Entity {

	public $name = 'Percentile';

 /**
 * Get the string contents and convert to array format.
 *
 *
 * @name getDataArray
 * @return students contents Array format
 */
    public function constructData($records)
    {
		foreach ($records as $key => $value) {
		   if(!empty($value)) {
				$records[$key] = explode(",",$value);
		   }
		}
		$check = true;
		foreach ($records as $key => $value)
           {
              if($records[$key] != '')
              {
               if(!empty($value[2]))
               {
                $records[$key][2] = number_format((float)$value[2], 2, '.', '');
               } else {
                 $check = false;
               }
              }
           }
           if($check)
           {
              return $records;
           } else
           {
             echo "Unknown Input Format";
           }
    }

}