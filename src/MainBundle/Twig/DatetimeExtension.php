<?php
// src/MainBundle/Twig/DatetimeExtension.php
namespace MainBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Convert from UTC timezone to local timezone
 */
class DatetimeExtension extends \Twig_Extension
{
	protected $return_formated;
	protected $timezone;

	public function __construct(ContainerInterface $container)
	{
		$local_timezone 		= $container->get('session')->get('local_timezone');
		$this->return_formated 	= '';
		$this->timezone 		= $local_timezone;
	}

	public function getFunctions()
	{
		return array();
	}

	public function getFilters()
	{
		return array(
			'datetime' => new \Twig_Filter_Method($this, 'formatDatetime')
		);
	}

	public function formatDatetime($date, $format, $timezone = null)
	{
		if (null === $timezone) {
			$timezone = $this->timezone;
		}

		if (!$date instanceof \DateTime) {
			if (ctype_digit((string) $date)) {
				$date = new \DateTime('@'.$date);
			} else {
				$date = new \DateTime($date);
			}
		}

		if (!$timezone instanceof \DateTimeZone) {
			$timezone = new \DateTimeZone($timezone);
		}

		$date->setTimezone($timezone);

		if($format == 'time') {
			$this->return_formated = $date->format('h:i A');
		} else if($format == 'date') {
			$this->return_formated = $date->format('Y-m-d');
		} else if($format == 'datetime') {
			$this->return_formated = $date->format('Y-m-d h:i A');
		}	
		
		return $this->return_formated;
	}

	public function getName()
	{
		return 'locale_extension';
	}
}
