<?php

namespace Pbc\Bandolier\Validate;

/**
 * Class Email
 * @package Pbc\Bandolier\Validate
 */
class Email
{
    /** @var array */
    protected $filters = ['filter', 'dns'];
    /** @var  bool */
    protected $valid = false;

    /**
     * Validate an email address
     * @param $email
     * @return bool
     */
    public static function validate($email)
    {
        $validate = new Email();
        foreach ($validate->getFilters() as $filter) {
            $v = $validate->{'check' . ucfirst($filter)}($email);
            if ($v) {
                $validate->setValid(true);
                continue;
            } elseif (!$v) {
                $validate->setValid(false);
                break;
            }
        }

        return $validate->isValid();
    }

    /**
     * @param $email
     * @return bool
     */
    public function checkDns($email)
    {
        // Next check the domain is real.
        $domain = explode("@", $email, 2);
        return checkdnsrr($domain[1]);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function checkFilter($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @throws \Exception
     */
    public function setFilters($filters)
    {
        if (!is_array($filters)) {
            throw new \Exception('The filter value must be an array.');
        }
        $this->filters = $filters;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }
}
