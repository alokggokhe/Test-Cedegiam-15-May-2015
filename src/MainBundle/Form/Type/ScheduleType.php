<?php

namespace MainBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ScheduleType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder           
			->add('title', 'text')
			->add('firstname', 'text', array('label' => 'First name'))
			->add('owauuid', 'hidden')
			->add('owaonekeycode', 'hidden')
			->add('scheduleStatus', 'entity',
				array('class'   => 'MainBundle\Entity\ScheduleStatus',
				'property'  => 'name'))
			->add('lastname', 'text', array('label' => 'Last name'))
			->add('email', 'text', array('label' => 'Email address'))
			->add('phone', 'text')
			->add('scheduledatetime','datetime', array(
					'format' 			=> "yyyy-MM-dd HH:mm",
					'widget' 			=> "single_text",
					'view_timezone' 	=> $options['view_timezone'],
					'model_timezone' 	=> 'UTC'
			))
			->add('submit', 'submit');
	}
	
	/**
	 * @param OptionsResolverInterface $resolver
	 */
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
			'data_class' 		=> 'MainBundle\Entity\Schedule',
			'view_timezone'     => 'UTC'
		));
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return 'schedule';
	}
}

