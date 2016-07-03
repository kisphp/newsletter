<?php

namespace AppBundle\Utils;

class Status
{
    const DELETED = 0;
    const INACTIVE = 1;
    const ACTIVE = 2;

    const CSS_CLASS_DELETED = 'danger';
    const CSS_CLASS_INACTIVE = 'warning';
    const CSS_CLASS_ACTIVE = 'success';

    /**
     * @var array
     */
    protected static $actions = [
        self::DELETED => 'Deleted',
        self::INACTIVE => 'Inactive',
        self::ACTIVE => 'Active',
    ];

    /**
     * @param int $status
     *
     * @throws StatusException
     *
     * @return string
     */
    public static function getStatus($status)
    {
        $status = (int) $status;

        if (array_key_exists($status, static::$actions)) {
            return '<span class="label label-' . self::getStatusCssClass($status) . '">' . static::$actions[$status] . '</span>';
        }

        throw new StatusException();
    }

    /**
     * @param int $status
     *
     * @throws StatusException
     *
     * @return string
     */
    protected static function getStatusCssClass($status)
    {
        $status = (int) $status;

        if ($status === self::DELETED) {
            return self::CSS_CLASS_DELETED;
        }
        if ($status === self::INACTIVE) {
            return self::CSS_CLASS_INACTIVE;
        }
        if ($status === self::ACTIVE) {
            return self::CSS_CLASS_ACTIVE;
        }

        throw new StatusException();
    }
}
