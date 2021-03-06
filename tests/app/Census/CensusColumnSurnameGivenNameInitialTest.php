<?php

/**
 * webtrees: online genealogy
 * Copyright (C) 2015 webtrees development team
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace Fisharebest\Webtrees\Census;

use Fisharebest\Webtrees\Individual;
use Mockery;

/**
 * Test harness for the class CensusColumnSurnameGivenNameInitial
 */
class CensusColumnSurnameGivenNameInitialTest extends \PHPUnit_Framework_TestCase {
	/**
	 * Delete mock objects
	 */
	public function tearDown() {
		Mockery::close();
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnSurnameGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testOneGivenName() {
		$individual = Mockery::mock('Fisharebest\Webtrees\Individual');
		$individual->shouldReceive('getAllNames')->andReturn(array(array('givn' => 'Joe', 'surn' => 'Sixpack')));

		$census = Mockery::mock('Fisharebest\Webtrees\Census\CensusInterface');

		$column = new CensusColumnSurnameGivenNameInitial($census, '', '');

		$this->assertSame('Sixpack, Joe', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnSurnameGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testMultipleGivenNames() {
		$individual = Mockery::mock('Fisharebest\Webtrees\Individual');
		$individual->shouldReceive('getAllNames')->andReturn(array(array('givn' => 'Joe Fred', 'surn' => 'Sixpack')));

		$census = Mockery::mock('Fisharebest\Webtrees\Census\CensusInterface');

		$column = new CensusColumnSurnameGivenNameInitial($census, '', '');

		$this->assertSame('Sixpack, Joe F', $column->generate($individual));
	}

	/**
	 * @covers Fisharebest\Webtrees\Census\CensusColumnSurnameGivenNameInitial
	 * @covers Fisharebest\Webtrees\Census\AbstractCensusColumn
	 */
	public function testNoName() {
		$individual = Mockery::mock('Fisharebest\Webtrees\Individual');
		$individual->shouldReceive('getAllNames')->andReturn(array());

		$census = Mockery::mock('Fisharebest\Webtrees\Census\CensusInterface');

		$column = new CensusColumnSurnameGivenNameInitial($census, '', '');

		$this->assertSame('', $column->generate($individual));
	}
}
