<?php
/**
 * Copyright (c) 2013 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */


namespace OC\DB;

class AdapterOCI8 extends Adapter {
	public function fixupStatement($statement) {
		$statement = str_replace( '`', '"', $statement );
		$statement = str_ireplace( 'NOW()', 'CURRENT_TIMESTAMP', $statement );
		return $statement;
	}
}
