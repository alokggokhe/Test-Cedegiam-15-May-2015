<?php

namespace MainBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class OptionController extends Controller
{
	public function indexAction()
	{
		$name = '';
		$webinar_params = '';
		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$name = $this->get('security.context')->getToken()->getUser()->getUsername();
			$firstname = $this->get('security.context')->getToken()->getUser()->getFirstname();

			$webinar_params = '?name='. $name .'&firstname='. $firstname;
		}

	    $home_privacy = $this->container->getParameter('home_privacy');        

		return $this->render('MainBundle:Option:option.html.twig', array('name' => $name, 'webinar_params' => $webinar_params, 'privacy' => $home_privacy));
	}

	public function remotePatientAction()
	{
		$ucb_patient_params = '';
		$ucb_patient_action	= '';	
		$home_privacy = $this->container->getParameter('home_privacy');
		if($this->get('security.context')->getToken()->getUser() instanceof OwaUser){
			$ucb_patient_params = '';
			$ucb_patient_action = $this->container->getParameter('ucb_patient_login') . $ucb_patient_params;
		}

		return $this->render('MainBundle:Option:remote_patient_option.html.twig', array( 
			'ucb_patient_action' => $ucb_patient_action, 'privacy' => $home_privacy));
	}
}
