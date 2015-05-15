<?php

namespace MainBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ScheduleRepositor extends EntityRepository
{
	public function getUpcomingSchdule($owaonekeycode)
	{
		$qb = $this->createQueryBuilder('s');
		$qb->select('s.')
			->from('MainBundle:Schdule', 's')
			->innerJoin('m.topics', 'mt')
			->groupBy('m.id')
			->orderBy('cnt', 'DESC');

		return $qb->getQuery()->getResult();
	}
}
