<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use App\Model\Entity\Percentile;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PercentileController extends AppController
{
	public $name = 'Percentile';
    public $components = array('Calculation');

    public function initialize()
    {
       parent::initialize();
       $percentileModel = new Percentile();
       $this->Percentile = $percentileModel;
    }
	
	public function index()
	{
		try
		{
			## The path of the text file
			$filePath = rootpath().'files/students.csv';
			$fileContent = $this->readFile($filePath); // Using a common function here which can be used from any controller
			$records = $this->Percentile->constructData($fileContent);
			$data = $this->calculatePercentile($records);
			$this->set('data',$data);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}
   
	public function calculatePercentile($records)
	{		
		$rank = array();
        if(!empty($records))
        {            
            $similarGpaRecords = $this->Calculation->findSameGpaScores($records); // This function is written in Percentile Component
			## We need total number of students to get the percentile
			$totalStudents = count($records);
			foreach ($records as $key => $value) {
				if(!empty($value)) {
					$gpa = utf8_encode($value['2']);
					$percentile = $this->Calculation->getPercentile($records,$totalStudents,$gpa,$similarGpaRecords);
					$rank[$key]['id'] = $value [0];
					$rank[$key]['name'] = preg_replace('/[^A-Za-z0-9\ ]/', '', $value [1]);
					$rank[$key]['percentile'] = $percentile;
					$rank[$key]['gpa'] = $value[2];
				}
			}
        }
        return  $rank;	
	}
	
}
