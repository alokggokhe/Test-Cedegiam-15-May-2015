<?php

namespace MainBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ScheduleRepository extends EntityRepository
{
	public function getUpcomingSchdule($owaonekeycode,$local_timezone)
	{
		$timezone = new \DateTimeZone($local_timezone);
		$today = new \DateTime();
		$today->setTimezone($timezone);
		$offset = $today->format('P');

		$qb = $this->createQueryBuilder('s');
		$qb->select('s')
			->innerJoin('s.scheduleStatus', 'st')
			->where('s.owaonekeycode = :owaonekeycode')
			->andWhere('st.id IN (:status)')
			->andWhere("SUBSTRING(CONVERT_TZ(s.scheduledatetime,'+00:00','".$offset."'),1,10) = :today")
			->setParameter('owaonekeycode', $owaonekeycode)
			->setParameter('status', array(1,2))
			->setParameter('today', $today->format('Y-m-d'))
			->orderBy('s.scheduledatetime', 'ASC');
		return $qb->getQuery()->getResult();
	}

	public function getFromTodaySchdule($owaonekeycode,$local_timezone)
	{
		$timezone = new \DateTimeZone($local_timezone);
		$today = new \DateTime();
		$today->setTimezone($timezone);
		$offset = $today->format('P');

		$qb = $this->createQueryBuilder('s');
		$qb->select('s')
			->innerJoin('s.scheduleStatus', 'st')
			->where('s.owaonekeycode = :owaonekeycode')
			->andWhere('st.id IN (:status)')
			->andWhere("SUBSTRING(CONVERT_TZ(s.scheduledatetime,'+00:00','".$offset."'),1,10) >= :today")
			->setParameter('owaonekeycode', $owaonekeycode)
			->setParameter('status', array(1,2,3))
			->setParameter('today', $today->format('Y-m-d'))
			->orderBy('s.scheduledatetime', 'ASC');
		return $qb->getQuery()->getResult();
	}
}
