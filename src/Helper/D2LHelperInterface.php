<?php

namespace SmithAndAssociates\LaravelValence\Helper;

interface D2LHelperInterface
{
	/**
	 * Retrieve data for one or more users.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getUsers($params = []);

	/**
	 * Retrieve properties for all org units.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getOrgStructure($params = []);

	/**
	 * Retrieve all the known and visible org unit types.
	 *
	 * @return mixed
	 */
	public function getOuTypes();

	/**
	 * Retrieve all org units that have no children.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getChildless($params = []);

	/**
	 * Retrieve the table of course content for an org unit.
	 *
	 * @param $orgUnitId
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getCourseTOC($orgUnitId, $params = []);

	/**
	 * Retrieve the users in the classlist who are able to earn awards along with their first ten awards.
	 *
	 * @param $orgUnit
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getOrgClassAwards($orgUnit, $params = []);

	/**
	 * Retrieve the results for a query-based search across one or more repositories.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function searchObjects($params = []);

	/**
	 * Retrieve all repositories with the Search trust permission.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getAllRepositories($params = []);

	/**
	 * Retrieve all supported versions for all product components.
	 *
	 * @param $productCode
	 *
	 * @return mixed
	 */
	public function getVersions($productCode);

	/**
	 * Retrieve the awards issued to a user.
	 *
	 * @param $userId
	 * @param $params
	 *
	 * @return mixed
	 */
	public function getUserAwards($userId, $params = []);
	/**
	 * Retrieve awards available across the organization.
	 *
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getAwards($params = []);

	/**
	 * Retrieve the enrolled users in the classlist for an org unit.
	 *
	 * @param $orgUnitId
	 *
	 * @return mixed
	 */
	public function getClassList($orgUnitId);

	/**
	 * Retrieve a list of ancestor-units for a provided org unit.
	 *
	 * @param $orgUnitId
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getAncestors($orgUnitId, $params = []);

	/**
	 * Retrieve a list of descendent-units for a provided org unit.
	 *
	 * @param $orgUnitId
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function getDescendants($orgUnitId, $params = []);

	/**
	 * Add Query Parameters.
	 *
	 * @param $path
	 * @param array $params
	 *
	 * @return mixed
	 */
	public function addQueryParameters($path, $params = []);
}