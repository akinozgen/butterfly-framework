<?php
/**
 * Created by PhpStorm.
 * User: Akın Özgen
 * Date: 20.06.2017
 * Time: 11:41
 */
namespace Butterfly\System;
/**
 * Description of Database
 * @var string $tocreate
 * @var string $query
 * @var string $orders
 * @var string $joins
 * @var string $todelete
 * @var string $toinsert
 * @var string $toselect
 * @var string $toupdate
 * @var string $wheres
 * @author Akın Özgen
 */
class Database extends \PDO
{
    private $toselect = false;
    private $toinsert = false;
    private $toupdate = false;
    private $todelete = false;
    private $tocreate = false;
    private $wheres = false;
    private $orders = false;
    private $joins  = false;
    private $query  = false;

    /**
     * Database constructor.
     * @param $dsn
     * @param null $username
     * @param null $password
     * @param null $options
     */
    public function __construct($conf, $options = null) {
        try {
            $dsn = $conf['driver'].':dbname='.  $conf['name'] .
                ';host='.    $conf['host']['name'] .
                ';charset='. $conf['charset'];
            $username = $conf['host']['user'];
            $password = $conf['host']['password'];

            parent::__construct($dsn, $username, $password, $options);
        } catch (Exception $exc) {
            throw new Exception($exc->getErrorCode());
        }
    }

    /**
     *
     * @param array|string $fields
     * for ex. ['user' => 'AkinOzgen17', 'pass' => '123456', 'Id' => '1']
     */
    public function select($table, $fields)
    {
        $this->toselect = $this->toselect == NULL ? "SELECT [fields] FROM {$table} " : $this->toselect;
        if ( is_array($fields) )
        {
            $flds = '';
            foreach ($fields as $key => $value) {
                if (is_integer($key))
                {
                    $flds .= $value . ', ';
                }
                else
                {
                    $flds .= "{$key} AS {$value}, ";
                }
            }
            // Delete last Comma
            $fields = \substr($flds, 0, \strlen($flds) - 2);
        }
        $this->toselect = \str_replace('[fields]', $fields, $this->toselect);

        return $this;
    }

    /**
     * @param array|string $fields
     * @param null $statement
     * @return $this
     */
    public function where($fields, $statement = NULL)
    {
        $this->wheres = $this->wheres == NULL ? " WHERE [fields] " : $this->wheres;
        if ( is_array($fields) )
        {
            $flds = '';
            foreach ($fields as $key => $value)
            {
                $key = str_replace("*", "", $key);
                $flds .= "{$key} = '{$value}' {$statement} ";
            }
            // Delete last statement
            $fields = \substr($flds, 0, (\strlen($flds) - (\strlen($statement) + 1)));
        }
        $this->wheres = \str_replace('[fields]', $fields, $this->wheres) . " ";

        return $this;
    }

    /**
     * @param string $join
     * @param string $table1
     * @param string $table2
     * @param string $column1
     * @param string $column2
     * @return $this
     */
    public function join($join, $table1, $table2, $column1, $column2)
    {
        $this->joins .= " " . strtoupper($join) . " JOIN {$table2} ON {$table1}.{$column1} = {$table2}.{$column2} ";

        return $this;
    }

    /**
     * @param string $field
     * @param string $rule
     * @return $this
     */
    public function order($field, $rule)
    {
        $this->orders = " ORDER BY {$field} " . strtoupper($rule) . " ";

        return $this;
    }

    /**
     * @param string $table
     * @param array|string|object $fields
     * @return $this
     */
    public function insert($table, $fields)
    {
        $fields = (object) array_filter((array) $fields, function ($val) {
            return !is_null($val);
        });
        $this->toinsert = "INSERT INTO {$table} SET [fields] ";
        if ( is_array($fields) OR is_object($fields) )
        {
            $flds = '';
            foreach ($fields as $key => $value) {
                if (is_integer($key))
                {
                    $flds .= $value . ', ';
                }
                else
                {
                    $flds .= "`{$key}` = '{$value}', ";
                }
            }
            // Delete last Comma
            $fields = \substr($flds, 0, \strlen($flds) - 2);
        }
        $this->toinsert = str_replace('[fields]', $fields, $this->toinsert);

        return $this;
    }

    /**
     * @param string $table
     * @param array|string|object $fields
     * @return $this
     */
    public function update($table, $fields)
    {
        $fields = (object) array_filter((array) $fields, function ($val) {
            return !is_null($val);
        });
        $this->toupdate = "UPDATE {$table} SET [fields] ";
        if ( is_array($fields) OR is_object($fields) )
        {
            $flds = '';
            foreach ($fields as $key => $value) {
                if (is_integer($key))
                {
                    $flds .= $value . ', ';
                }
                else
                {
                    $flds .= "{$key} = '{$value}', ";
                }
            }
            // Delete last Comma
            $fields = \substr($flds, 0, \strlen($flds) - 2);
        }
        $this->toupdate = str_replace('[fields]', $fields, $this->toupdate);

        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function delete($table)
    {
        $this->todelete = "DELETE FROM {$table} ";

        return $this;
    }

    /**
     * @param string $tablename
     * @param array $columns
     * @param string $primary
     * @return $this
     */
    public function createTable($tablename, $columns, $primary)
    {
        $this->tocreate = "CREATE TABLE IF NOT EXISTS {$tablename} (\n\t[columns] [primary]\n) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        if (is_array($columns) )
        {
            $clmns = '';
            foreach ($columns as $columnName => $specs)
            {
                $clmns .= "{$columnName} {$specs}, \n\t";
            }
            $clmns = \substr($clmns, 0, \strlen($clmns) - 2);
        }
        $this->tocreate = str_replace('[columns]', $clmns, $this->tocreate);
        $this->tocreate = str_replace('[primary]', 'PRIMARY KEY (`'. $primary .'`)', $this->tocreate);

        return $this;
    }

    /**
     * @param int $start
     * @param int $stop
     * @return $this
     */
    public function limit($start, $stop) {
        $this->orders .= " LIMIT {$start}, {$stop} ";
        return $this;
    }

    /**
     * @param int $fetchType
     * @return \PDOStatement
     */
    public function exec($fetchType = parent::FETCH_ASSOC)
    {
        $this->prepareQuery();

        if ( ! $fetchType )
            return $this->query($this->query);
        else
            return $this->query($this->query, $fetchType);
    }

    /**
     * Description of PrepareQuery
     * It builds query
     */
    public function prepareQuery()
    {
        if ($this->toselect)
            $this->query = $this->toselect . $this->joins . $this->wheres . $this->orders;
        else if ($this->toinsert)
            $this->query = $this->toinsert;
        else if ($this->toupdate)
            $this->query = $this->toupdate . $this->wheres;
        else if ($this->todelete)
            $this->query = $this->todelete . $this->wheres;
        else if ($this->tocreate)
            $this->query = $this->tocreate;

    }

    /**
     * Description of CleanQuery
     * It makes query clean
     * @return $this
     */
    public function clean()
    {
        $this->joins = NULL;
        $this->orders = NULL;
        $this->query = NULL;
        $this->tocreate = NULL;
        $this->todelete = NULL;
        $this->toinsert = NULL;
        $this->toselect = NULL;
        $this->toupdate = NULL;
        $this->wheres = NULL;

        return $this;
    }

    /**
     * @param null $name
     * @return string
     */
    public function lastInsertId($name = null) {
        return parent::lastInsertId($name);
    }

    /**
     * @return string
     */
    public function getQuery() {
        return $this->query;
    }
}
