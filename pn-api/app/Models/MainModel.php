<?php

namespace App\Models;

use League\MongaModel;

/**
 * Class MainModel
 * @package App\Models
 */
class MainModel extends MongaModel {

    protected static $monga;
    protected static $monga_resume;
    protected static $monga_portfolio;

    /**
     * Admin constructor.
     *
     * @param $monga_master
     */
    public function __construct( $type ) {

        # Call MongaModel and initialize a database connection;
        self::$monga = new MongaModel(env("MONGODB_DSN_MASTER"), env("MONGODB_NAME_MASTER"));
    }
}