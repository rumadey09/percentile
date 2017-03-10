<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         1.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase\Controller;

use Cake\Core\App;
use Cake\Core\Configure;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\IntegrationTestCase;
use Cake\View\Exception\MissingTemplateException;
use App\Controller\PercentileController;
use App\Model\Entity\Percentile;
use App\Controller\Component\CalculationComponent;
use Cake\Controller\ComponentRegistry;
//use App\Controller\AppController;

/**
 * PagesControllerTest class
 */
class PercentileControllerTest extends IntegrationTestCase
{
    public $studentList = [
            ['Randy Perez', '1.2',10],
            ['Alice Brown', '2.20',30],
            ['Maria Russell', '3.50',70],
            ['Shirley Evans', '3.90',90],
            ['Daniel Bell', '3.4',50],
        ];
	public $students = [
            [471908, 'Randy Perez', '1.60'],
            [957625, 'Alice Brown', '3.50'],
            [909401, 'Maria Russell', '2.20'],
            [780367, 'Shirley Evans', '2.72'],
            [841786, 'Daniel Bell', '3.50'],
        ];
    public function setUp()
    {
        parent::setUp();
        $request = new Request();
        $response = new Response();
        $this->controller = $this->getMockBuilder('Cake\Controller\Controller')
            ->setConstructorArgs([$request, $response])
            ->setMethods(null)
            ->getMock();
        $registry = new ComponentRegistry($this->controller);
        $this->component = new CalculationComponent($registry);
    }

     /**
     * Testing all the students percentile Rank
     *
     * @return void
     */
    public function testOverallRank()
    {
        $this->Percentile = new PercentileController();
        $file = WWW_ROOT.'files/students-test.csv';   //Support txt or csv files. //Get the Students ID, name & GPA Details
        $studentData = $this->Percentile->readFile($file);

        $percentileModel = new Percentile();
        //Call Student Entity
        $studentsDataArray = $percentileModel->constructData($studentData);

        $students = $this->Percentile->calculatePercentile($studentsDataArray);//print_r($students); exit;
		$results = array();
        foreach ($students as $key => $value)
        {
           $results[$key] = array($value['name'],$value['gpa'],$value['percentile']);
        }
        $this->assertEquals($this->studentList, $results);
    }
	public function testRankForSingleStudent()
    {
		$studentsArray = $this->students;
		if(!empty($studentsArray))
		{
			$toaltStudents = count($studentsArray);
			$sameGpaScore = $this->component->findSameGpaScores($studentsArray); // found in calculation component

			$percentile = $this->component->getPercentile($studentsArray,$toaltStudents,'2.20',$sameGpaScore);
			$this->assertEquals(30, $percentile);
      }
    }
}
