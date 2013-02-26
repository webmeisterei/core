<?php
/**
 * Copyright (c) 2013 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

namespace OC\DB;

class Adapter {
	protected $conn;

	public function __construct($conn) {
		$this->conn = $conn;
	}

	public function lastInsertId($table) {
		return $this->conn->realLastInsertId($table);
	}

	public function fixupStatement($statement) {
		return $statement;
	}

	public function insertIfNotExist($table, $input) {
		$query = 'INSERT INTO `' .$table . '` ('
			. implode(',', array_keys($input)) . ') SELECT \''
			. implode('\',\'', array_values($input)) . '\' FROM ' . $table . ' WHERE ';

		foreach($input as $key => $value) {
			$query .= $key . " = '" . $value . '\' AND ';
		}
		$query = substr($query, 0, strlen($query) - 5);
		$query .= ' HAVING COUNT(*) = 0';

		try {
			$result = $this->conn->prepare($query);
		} catch(\Doctrine\DBAL\DBALException $e) {
			$entry = 'DB Error: "'.$e->getMessage() . '"<br />';
			$entry .= 'Offending command was: ' . $query.'<br />';
			OC_Log::write('core', $entry, OC_Log::FATAL);
			error_log('DB error: ' . $entry);
			OC_Template::printErrorPage( $entry );
		}

		return $result->execute();
	}
}
