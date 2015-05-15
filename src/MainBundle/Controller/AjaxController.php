<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/ajax")
 * 
 */

class AjaxController extends Controller
{
	/**
     * @Route("/set_user_timezone", name="ajax_set_user_timezone")
     * @Method({"POST"})
     */
	public function setUserTimeZoneAction(Request $request)
	{
		try {
			$is_dst					= true;
			$time_zone_offset 		= $request->request->get('time_zone_offset');
			$daylight_savings_time 	= $request->request->get('daylight_savings_time');
			
			if ($daylight_savings_time == 1) {
				$is_dst	= true;
			} else {
				$is_dst	= false;
			}

			$time_zone_name		= timezone_name_from_abbr('',($time_zone_offset/60)*3600,$is_dst);

			if($time_zone_name == '') {
				$time_zone_name = 'UTC';
			}

			$this->get('session')->set('local_timezone',$time_zone_name);

			$a_response['s_status'] = 'success';
			$a_response['data']     = $time_zone_name;

		} catch(Exception $e) {

			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();

		}
		
		return new JsonResponse($a_response);	
	}
}
