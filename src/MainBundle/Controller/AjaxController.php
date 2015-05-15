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
			$time_zone_abbr 	= $request->request->get('time_zone_abbr');
			$time_zone_offset 	= $request->request->get('time_zone_offset');
			$time_zone_name		= timezone_name_from_abbr($time_zone_abbr,($time_zone_offset/60)*3600);
			if($time_zone_name == '') {
				$time_zone_name = 'UTC';
			}
			$this->get('session')->set('local_timezone',$time_zone_name);
			$a_response['s_status'] = 'success';
			$a_response['data']     = '';
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);	
	}	
}
