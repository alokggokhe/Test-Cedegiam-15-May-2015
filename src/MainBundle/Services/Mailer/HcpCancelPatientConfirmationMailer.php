<?php

namespace MainBundle\Services\Mailer;


use Doctrine\ORM\EntityManager;
use MainBundle\Entity\Schedule;
use Cegedim\Bundle\OwaCasBundle\Security\User\OwaUser;

class HcpCancelPatientConfirmationMailer
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
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function sendMail(Schedule $schedule, OwaUser $owauser)
	{
		$message = \Swift_Message::newInstance()
			->setSubject('Cancellation of ' . $schedule->getTitle() . ' Presentation')
			// ->setFrom($owauser->getEmail())
			->setFrom('alokggokhe@ymail.com')
			->setTo($schedule->getEmail())
			->setBody($this->templating->render('MainBundle:Mail:hcp_cancel_patient_confirmation.html.twig', array(
				'schedule' 	=> $schedule,
				'owauser'	=> $owauser
			)),'text/html');

		if($owauser->getEmail() && !empty($owauser->getEmail())){
			//$message->setCc($owauser->getEmail());
			$message->setCc('nirajm@alohatechnology.com');
		}

		$this->mailer->send($message);

		return true;
	}
}
