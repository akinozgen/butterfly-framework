<?php

namespace Butterfly\System;

/**
 *
 * @author Akın Özgen
 */
interface ModelInterface {

    /**
     * @param array $where
     * @return any|null
     */
    function get($where, $where_statement = 'AND');

    /**
     * @return any|null
     */
    function getAll();

    /**
     * @param array $data
     * @return \PDOStatement
     */
    function insert($data);

    /**
     * @param object $data
     * @param array $where
     * @return \PDOStatement
     */
    function update($data, $where, $where_statement = 'AND');

    /**
     * @param array $where
     * @return \PDOStatement
     */
    public function delete($where, $where_statement = 'AND');
}
