<?php

namespace models\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use models\models\Sucursal as ChildSucursal;
use models\models\SucursalQuery as ChildSucursalQuery;
use models\models\Map\SucursalTableMap;

/**
 * Base class that represents a query for the 'sucursal' table.
 *
 *
 *
 * @method     ChildSucursalQuery orderByIdsucursal($order = Criteria::ASC) Order by the idSucursal column
 * @method     ChildSucursalQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildSucursalQuery orderByActivo($order = Criteria::ASC) Order by the activo column
 *
 * @method     ChildSucursalQuery groupByIdsucursal() Group by the idSucursal column
 * @method     ChildSucursalQuery groupByNombre() Group by the nombre column
 * @method     ChildSucursalQuery groupByActivo() Group by the activo column
 *
 * @method     ChildSucursalQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildSucursalQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildSucursalQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildSucursalQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildSucursalQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildSucursalQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildSucursalQuery leftJoinBoleta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Boleta relation
 * @method     ChildSucursalQuery rightJoinBoleta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Boleta relation
 * @method     ChildSucursalQuery innerJoinBoleta($relationAlias = null) Adds a INNER JOIN clause to the query using the Boleta relation
 *
 * @method     ChildSucursalQuery joinWithBoleta($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Boleta relation
 *
 * @method     ChildSucursalQuery leftJoinWithBoleta() Adds a LEFT JOIN clause and with to the query using the Boleta relation
 * @method     ChildSucursalQuery rightJoinWithBoleta() Adds a RIGHT JOIN clause and with to the query using the Boleta relation
 * @method     ChildSucursalQuery innerJoinWithBoleta() Adds a INNER JOIN clause and with to the query using the Boleta relation
 *
 * @method     \models\models\BoletaQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildSucursal findOne(ConnectionInterface $con = null) Return the first ChildSucursal matching the query
 * @method     ChildSucursal findOneOrCreate(ConnectionInterface $con = null) Return the first ChildSucursal matching the query, or a new ChildSucursal object populated from the query conditions when no match is found
 *
 * @method     ChildSucursal findOneByIdsucursal(int $idSucursal) Return the first ChildSucursal filtered by the idSucursal column
 * @method     ChildSucursal findOneByNombre(string $nombre) Return the first ChildSucursal filtered by the nombre column
 * @method     ChildSucursal findOneByActivo(int $activo) Return the first ChildSucursal filtered by the activo column *

 * @method     ChildSucursal requirePk($key, ConnectionInterface $con = null) Return the ChildSucursal by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSucursal requireOne(ConnectionInterface $con = null) Return the first ChildSucursal matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSucursal requireOneByIdsucursal(int $idSucursal) Return the first ChildSucursal filtered by the idSucursal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSucursal requireOneByNombre(string $nombre) Return the first ChildSucursal filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildSucursal requireOneByActivo(int $activo) Return the first ChildSucursal filtered by the activo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildSucursal[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildSucursal objects based on current ModelCriteria
 * @method     ChildSucursal[]|ObjectCollection findByIdsucursal(int $idSucursal) Return ChildSucursal objects filtered by the idSucursal column
 * @method     ChildSucursal[]|ObjectCollection findByNombre(string $nombre) Return ChildSucursal objects filtered by the nombre column
 * @method     ChildSucursal[]|ObjectCollection findByActivo(int $activo) Return ChildSucursal objects filtered by the activo column
 * @method     ChildSucursal[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class SucursalQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\SucursalQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Sucursal', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildSucursalQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildSucursalQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildSucursalQuery) {
            return $criteria;
        }
        $query = new ChildSucursalQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildSucursal|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(SucursalTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = SucursalTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildSucursal A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idSucursal, nombre, activo FROM sucursal WHERE idSucursal = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildSucursal $obj */
            $obj = new ChildSucursal();
            $obj->hydrate($row);
            SucursalTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildSucursal|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idSucursal column
     *
     * Example usage:
     * <code>
     * $query->filterByIdsucursal(1234); // WHERE idSucursal = 1234
     * $query->filterByIdsucursal(array(12, 34)); // WHERE idSucursal IN (12, 34)
     * $query->filterByIdsucursal(array('min' => 12)); // WHERE idSucursal > 12
     * </code>
     *
     * @param     mixed $idsucursal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByIdsucursal($idsucursal = null, $comparison = null)
    {
        if (is_array($idsucursal)) {
            $useMinMax = false;
            if (isset($idsucursal['min'])) {
                $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $idsucursal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idsucursal['max'])) {
                $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $idsucursal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $idsucursal, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SucursalTableMap::COL_NOMBRE, $nombre, $comparison);
    }

    /**
     * Filter the query on the activo column
     *
     * Example usage:
     * <code>
     * $query->filterByActivo(1234); // WHERE activo = 1234
     * $query->filterByActivo(array(12, 34)); // WHERE activo IN (12, 34)
     * $query->filterByActivo(array('min' => 12)); // WHERE activo > 12
     * </code>
     *
     * @param     mixed $activo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByActivo($activo = null, $comparison = null)
    {
        if (is_array($activo)) {
            $useMinMax = false;
            if (isset($activo['min'])) {
                $this->addUsingAlias(SucursalTableMap::COL_ACTIVO, $activo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activo['max'])) {
                $this->addUsingAlias(SucursalTableMap::COL_ACTIVO, $activo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(SucursalTableMap::COL_ACTIVO, $activo, $comparison);
    }

    /**
     * Filter the query by a related \models\models\Boleta object
     *
     * @param \models\models\Boleta|ObjectCollection $boleta the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildSucursalQuery The current query, for fluid interface
     */
    public function filterByBoleta($boleta, $comparison = null)
    {
        if ($boleta instanceof \models\models\Boleta) {
            return $this
                ->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $boleta->getIdsucursal(), $comparison);
        } elseif ($boleta instanceof ObjectCollection) {
            return $this
                ->useBoletaQuery()
                ->filterByPrimaryKeys($boleta->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBoleta() only accepts arguments of type \models\models\Boleta or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Boleta relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function joinBoleta($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Boleta');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Boleta');
        }

        return $this;
    }

    /**
     * Use the Boleta relation Boleta object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\BoletaQuery A secondary query class using the current class as primary query
     */
    public function useBoletaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBoleta($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Boleta', '\models\models\BoletaQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildSucursal $sucursal Object to remove from the list of results
     *
     * @return $this|ChildSucursalQuery The current query, for fluid interface
     */
    public function prune($sucursal = null)
    {
        if ($sucursal) {
            $this->addUsingAlias(SucursalTableMap::COL_IDSUCURSAL, $sucursal->getIdsucursal(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the sucursal table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SucursalTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            SucursalTableMap::clearInstancePool();
            SucursalTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SucursalTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(SucursalTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            SucursalTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            SucursalTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // SucursalQuery
