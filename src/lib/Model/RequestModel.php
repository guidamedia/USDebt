<?php
/**
 * Created by PhpStorm.
 * User: robert
 * Date: 6/3/18
 * Time: 6:55 PM
 */

namespace USDebt\Model;

use DateTime;
use InvalidArgumentException;
use USDebt\Service\ValidateDateTime;

class RequestModel
{
    /** @var DateTime */
    private $startDate;

    /** @var DateTime */
    private $endDate;

    /** @var array */
    private $compare_pres;

    /**
     * @param int $input
     */
    public function addComparePres($input)
    {
        if (false === filter_var($input, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException("{$input} is not a valid integer");
        }
        $this->compare_pres[] = $input;
    }

    /**
     * @param array $input
     */
    public function setComparePres(array $input)
    {
        if (1 >= count($input)) {
            throw new InvalidArgumentException("You must select at least 2 presidents");
        }
        $this->compare_pres = $input;
    }

    /**
     * @return array
     */
    public function getComparePres()
    {
        return $this->compare_pres;
    }

    /**
     * @param bool $ref
     * @return DateTime
     */
    public function getStartDate($ref = false)
    {
        return ($ref) ? $this->startDate : clone $this->startDate;
    }

    /**
     * @param string|DateTime $start_date
     */
    public function setStartDate($start_date)
    {
        if ($start_date instanceof  DateTime) {
            $this->startDate = $start_date;
        } elseif (ValidateDateTime::validate($start_date)) {
            if (!$start_date instanceof DateTime) {
                $start_date = new DateTime($start_date);
            }
            $this->startDate = $start_date;
        }
    }

    /**
     * @param bool $ref
     * @return DateTime
     */
    public function getEndDate($ref = false)
    {
        return ($ref) ? $this->endDate : clone $this->endDate;
    }

    /**
     * @param string|DateTime $end_date
     */
    public function setEndDate($end_date)
    {
        if ($end_date instanceof  DateTime) {
            $this->endDate = $end_date;
        } elseif (ValidateDateTime::validate($end_date)) {
            if (!$end_date instanceof DateTime) {
                $end_date = new DateTime($end_date);
            }
            $this->endDate = $end_date;
        }
    }
}
