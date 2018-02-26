<?php

namespace Samknows\Repository;

use Samknows\Repository\QueryBuilder\DataPoint as DataPointRepository;
use Doctrine\ORM\QueryBuilder;

/**
 * Description of DataPoint
 *
 * @author paul
 */
class DataPoint extends DataPointRepository
{
    public function aggregate()
    {
        /* @var $qb QueryBuilder */
        $qb = $this->createQueryBuilder('dp');
        foreach (\Samknows\METRICS as $metric) {
            foreach (\Samknows\DOCTRINE_SUPPORTED_INDICATORS as $indicator) {
                $qb->addSelect('');
            }
        }
                ->select([
                 'AVG(dp.download) avg_download',
                 'MIN(dp.downlad) min_download'
                ]);
    }
}
