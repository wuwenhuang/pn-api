<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;

class UserModel extends MainModel
{
    /** @var  \League\MongaModel $db */
    protected $db;

    /** @var  \League\MongaModel $db_resume */
    protected $db_resume;

    protected $parent_page;

    /**
     * Admin constructor.
     *
     * @param $monga_master
     */
    public function __construct() {

        # Call MongaModel and initialize a database connection;
        parent::__construct( 'MASTER' );

        self::set_db();
    }
    /**
     * Set database connection
     */
    protected function set_db(){

        # Inherit database connection from parent page
        $this->db = parent::$monga;
    }

    /**
     * Get users
     *
     * @return array
     */
    protected function get_users()
    {
        $users = $this->db->find('users', [], []);
        return $users;
    }

    /**
     * Find user
     *
     * @param array $info
     * @return array|bool
     */
    protected function find_user($info = [])
    {
        $result = false;

        if ($info) {
            $info = unserialize($info);
        }

        if (isset($info['where']))
        {
            $where = $info['where'];
            if (isset($where)) {
                $where['password'] = app('hash')->make('password');
            }

            $result = $this->db->find('users', $where);
        }
        return $result;
    }

    /**
     * User change password
     *
     * @param array $info
     * @return array|bool
     */
    protected function change_password($info = [])
    {
        $result = false;

        if ($info) {
            $info = unserialize($info);
        }

        $where = [];
        if (isset($info['where']))
        {
            $where = $info['where'];
        }

        $set = [];
        if (isset($info['set'])) {
            $set = $info['set'];

            if (isset($set['password'])) {
                $set['password'] = app('hash')->make($set['password']);
            }
        }

        $result = $this->db->update('users', $where, $set, true);
        return $result;
    }

    /**
     * Create New User
     *
     * @param array $info
     * @return mixed
     */
    protected function create_user($info = [])
    {
        $result = false;

        if ($info) {
            $info = unserialize($info);
        }

        if (isset($info['insert']))
        {
            $insert = $info['insert'];

            if ($insert['password']) {
                $insert['password'] = app('hash')->make($insert['password']);
            }

            $result = $this->db->insert('users', $insert);
        }
        return $result;
    }
}