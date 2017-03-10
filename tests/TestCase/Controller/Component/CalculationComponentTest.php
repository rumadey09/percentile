<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\CalculationComponent;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\TestSuite\TestCase;


class PercentileComponentTest extends TestCase
{
    public $component = null;
    public $controller = null;

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
     * Testing Percentile Rank different GPA Mark
     *
     */

     public function testStudentsPercentile()
    {
       $studentsArray = $this->students;

      if(!empty($studentsArray))
      {
            $studentsTotal = count($studentsArray);
            $sameGpaScore = $this->component->findSameGpaScores($studentsArray,"2"); 

            $percentile = $this->component->getPercentile($studentsArray,$studentsTotal,'1.60', $sameGpaScore);
 
            $this->assertEquals(10, $percentile);
      }
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->component, $this->controller);
    }
}
?>
