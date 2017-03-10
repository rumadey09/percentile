<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\Core\App;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\Event\EventDispatcherTrait;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Request;
use Cake\Network\Response;
use Cake\Routing\Router;
use Cake\Utility\Hash;
/**
 * PercntileComponent
 * Using the formula (cl+.5*fi/N)*100% for percentile calculation, here cl is the count of all scores less than the score of interest, ƒi is the frequency of the score of interest, and N is the number of examinees in the sample
 * @package percentile
 */
    class CalculationComponent extends Component {

        /**
		* This function is used to calculate percentile score
		*/
        public function getPercentile($studentArray, $totalStudents=0, $gpa=0, $sameGpaScorer=array())
        {
			if (!empty($studentArray))
			{
				try {
					if(!empty($sameGpaScorer))
					{
						$y = $gpa;
						if (array_key_exists($gpa,$sameGpaScorer)){
						   $percentile = ((count(array_filter($studentArray, function ($x) use ($y) {return $x["2"] < $y;})) + (0.5 * $sameGpaScorer[$gpa]) )/($totalStudents)) * 100;
						   return $percentile;
						}
					}
				} catch (Exception $e) {
				  throw new Exception($e->getMessage());
				}
			}
        }

		/**
		* This function is used to get same gpas scorers
		*/
        public function findSameGpaScores($studentArray)
        {
            $sameGpaScorer = array_count_values(
                            array_map(function($value)
                            {
                                return $value['2'];
                            }, $studentArray)
                       );
            return $sameGpaScorer;
        }

    }
?>

