<?php

namespace MainBundle\Services\Mailer;


use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Schedule;
use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class HcpConfirmationMailer
{


	/**
	 * @var \Doctrine\ORM\EntityManager
	 */
	protected $em;

	protected $templating;

	protected $mailer;

	public function __construct(EntityManager $em, $templating, $mailer) {
		$this->em = $em;
		$this->templating = $templating;
		$this->mailer = $mailer;
	}

	/**
	 * @param Schedule $schedule MainBundle/Entity/Schedule
	 * @param OwaUser $schedule Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser
	 * @param ucb_patient_action $ucb_patient_action Dandelion Patient URL
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function sendMail(Schedule $schedule, OwaUser $owauser, $ucb_patient_action)
	{
		$message = \Swift_Message::newInstance()
			->setSubject('UpComing Patient Education Session - '. $schedule->getTitle())
			// ->setFrom('no-reply@dandelion.com')
			// ->setTo($owauser->getEmail())
			->setFrom('alokggokhe@ymail.com')
			->setTo('nirajm@alohatechnology.com')
			->setBody($this->templating->render('MainBundle:Mail:hcp_confirmation.html.twig', array(
				'schedule'					=> $schedule,
				'owauser'   				=> $owauser,
				'idetailling_patient_url'   => $ucb_patient_action,
				'idetailling_hcp_url'       => $ucb_patient_action,
			)),'text/html');

		$this->mailer->send($message);

		return true;
	}
}
