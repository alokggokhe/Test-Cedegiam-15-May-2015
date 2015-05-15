<?php

namespace MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomeController extends Controller
{
    public function indexAction()
    {	
    	if ($this->get('security.context')->isGranted('ROLE_USER')){
    		return $this->redirectToRoute('option');
   		}
        
        $action = $this->container->getParameter('owa_login');
        $home_privacy = $this->container->getParameter('home_privacy');        
        $service = $this->generateUrl('option', array(), true);
        $error_redirection =$this->generateUrl('homepage', array('error' => 'login'), true);

        $register = $action . '?_flowId=inscription-webflow&service='.$service;

        $display_error = $this->getRequest()->get('error');

        return $this->render('MainBundle:Home:index.html.twig', array('action' => $action, 'service' => $service, 'error_redirection' => $error_redirection, 'register'=> $register, 'display_error' => $display_error,'privacy' => $home_privacy));
    }
}
