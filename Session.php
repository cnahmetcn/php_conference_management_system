<?php
include_once ("Database.php");
@$session = new Session;
class Session
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;

        session_set_save_handler(
            array($this, "_open"),
            array($this, "_close"),
            array($this, "_read"),
            array($this, "_read2"),
            array($this, "_read3"),
            array($this, "_read4"),
            array($this, "_write"),
            array($this, "_destroy"),
            array($this, "_gc")
        );

        if(!isset($_SESSION)) {
            session_start();
        }
    }

    public function _open()
    {
        if ($this->db) {
            return true;
        }
        return false;
    }

    public function _read($id)
    {
        $old = time();
        $this->db->query('SELECT lastaccess FROM sessions WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            $row = $this->db->single();
            $erisim = $row['lastaccess'];
        } else {
            $erisim = 0;
        }
        if ($erisim > $old) {
            $this->db->query('SELECT data FROM sessions WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                $row = $this->db->single();
                return $row['data'];
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function _read2($id)
    {
        $old = time();
        $this->db->query('SELECT lastaccess FROM sessions WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            $row = $this->db->single();
            $erisim = $row['lastaccess'];
        } else {
            $erisim = 0;
        }
        if ($erisim > $old) {
            $this->db->query('SELECT data2 FROM sessions WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                $row = $this->db->single();
                return $row['data2'];
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function _read3($id)
    {
        $old = time();
        $this->db->query('SELECT lastaccess FROM sessions WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            $row = $this->db->single();
            $erisim = $row['lastaccess'];
        } else {
            $erisim = 0;
        }
        if ($erisim > $old) {
            $this->db->query('SELECT data3 FROM sessions WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                $row = $this->db->single();
                return $row['data3'];
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function _read4($id)
    {
        $old = time();
        $this->db->query('SELECT lastaccess FROM sessions WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            $row = $this->db->single();
            $erisim = $row['lastaccess'];
        } else {
            $erisim = 0;
        }
        if ($erisim > $old) {
            $this->db->query('SELECT data4 FROM sessions WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute()) {
                $row = $this->db->single();
                return $row['data4'];
            } else {
                return NULL;
            }
        } else {
            return NULL;
        }
    }

    public function _write($id, $data, $data2, $data3, $data4)
    {
        $access = time();
        $lastaccess = $access + (90000);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $this->db->query('REPLACE INTO sessions VALUES (:id, :access, :lastaccess, :data, :data2, :data3, :data4, :ip)');
        $this->db->bind(':id', $id);
        $this->db->bind(':access', $access);
        $this->db->bind(':lastaccess', $lastaccess);
        $this->db->bind(':data', $data);
        $this->db->bind(':data2', $data2);
        $this->db->bind(':data3', $data3);
        $this->db->bind(':data4', $data4);
        $this->db->bind(':ip', $ip);

        if ($this->db->execute()) {
            return true;
        }

        return false;
    }

    public function _destroy($id)
    {
        $this->db->query('DELETE FROM sessions WHERE id = :id');
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        }

        return false;
    }

    public function _gc()
    {
        $old = time();
        $this->db->query('DELETE FROM sessions WHERE lastaccess < :old');
        $this->db->bind(':old', $old);

        if ($this->db->execute()) {
            return true;
        }

        return false;
    }
}