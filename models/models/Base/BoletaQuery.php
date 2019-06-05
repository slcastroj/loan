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
use models\models\Boleta as ChildBoleta;
use models\models\BoletaQuery as ChildBoletaQuery;
use models\models\Map\BoletaTableMap;

/**
 * Base class that represents a query for the 'boleta' table.
 *
 *
 *
 * @method     ChildBoletaQuery orderByIdboleta($order = Criteria::ASC) Order by the idBoleta column
 * @method     ChildBoletaQuery orderByIdusuario($order = Criteria::ASC) Order by the idUsuario column
 * @method     ChildBoletaQuery orderByIdsucursal($order = Criteria::ASC) Order by the idSucursal column
 * @method     ChildBoletaQuery orderByFecha($order = Criteria::ASC) Order by the fecha column
 * @method     ChildBoletaQuery orderByTotal($order = Criteria::ASC) Order by the total column
 *
 * @method     ChildBoletaQuery groupByIdboleta() Group by the idBoleta column
 * @method     ChildBoletaQuery groupByIdusuario() Group by the idUsuario column
 * @method     ChildBoletaQuery groupByIdsucursal() Group by the idSucursal column
 * @method     ChildBoletaQuery groupByFecha() Group by the fecha column
 * @method     ChildBoletaQuery groupByTotal() Group by the total column
 *
 * @method     ChildBoletaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBoletaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBoletaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBoletaQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBoletaQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBoletaQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBoletaQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method     ChildBoletaQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method     ChildBoletaQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method     ChildBoletaQuery joinWithUsuario($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Usuario relation
 *
 * @method     ChildBoletaQuery leftJoinWithUsuario() Adds a LEFT JOIN clause and with to the query using the Usuario relation
 * @method     ChildBoletaQuery rightJoinWithUsuario() Adds a RIGHT JOIN clause and with to the query using the Usuario relation
 * @method     ChildBoletaQuery innerJoinWithUsuario() Adds a INNER JOIN clause and with to the query using the Usuario relation
 *
 * @method     ChildBoletaQuery leftJoinSucursal($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sucursal relation
 * @method     ChildBoletaQuery rightJoinSucursal($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sucursal relation
 * @method     ChildBoletaQuery innerJoinSucursal($relationAlias = null) Adds a INNER JOIN clause to the query using the Sucursal relation
 *
 * @method     ChildBoletaQuery joinWithSucursal($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Sucursal relation
 *
 * @method     ChildBoletaQuery leftJoinWithSucursal() Adds a LEFT JOIN clause and with to the query using the Sucursal relation
 * @method     ChildBoletaQuery rightJoinWithSucursal() Adds a RIGHT JOIN clause and with to the query using the Sucursal relation
 * @method     ChildBoletaQuery innerJoinWithSucursal() Adds a INNER JOIN clause and with to the query using the Sucursal relation
 *
 * @method     ChildBoletaQuery leftJoinDetalle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Detalle relation
 * @method     ChildBoletaQuery rightJoinDetalle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Detalle relation
 * @method     ChildBoletaQuery innerJoinDetalle($relationAlias = null) Adds a INNER JOIN clause to the query using the Detalle relation
 *
 * @method     ChildBoletaQuery joinWithDetalle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Detalle relation
 *
 * @method     ChildBoletaQuery leftJoinWithDetalle() Adds a LEFT JOIN clause and with to the query using the Detalle relation
 * @method     ChildBoletaQuery rightJoinWithDetalle() Adds a RIGHT JOIN clause and with to the query using the Detalle relation
 * @method     ChildBoletaQuery innerJoinWithDetalle() Adds a INNER JOIN clause and with to the query using the Detalle relation
 *
 * @method     \models\models\UsuarioQuery|\models\models\SucursalQuery|\models\models\DetalleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBoleta findOne(ConnectionInterface $con = null) Return the first ChildBoleta matching the query
 * @method     ChildBoleta findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBoleta matching the query, or a new ChildBoleta object populated from the query conditions when no match is found
 *
 * @method     ChildBoleta findOneByIdboleta(int $idBoleta) Return the first ChildBoleta filtered by the idBoleta column
 * @method     ChildBoleta findOneByIdusuario(int $idUsuario) Return the first ChildBoleta filtered by the idUsuario column
 * @method     ChildBoleta findOneByIdsucursal(int $idSucursal) Return the first ChildBoleta filtered by the idSucursal column
 * @method     ChildBoleta findOneByFecha(string $fecha) Return the first ChildBoleta filtered by the fecha column
 * @method     ChildBoleta findOneByTotal(int $total) Return the first ChildBoleta filtered by the total column *

 * @method     ChildBoleta requirePk($key, ConnectionInterface $con = null) Return the ChildBoleta by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBoleta requireOne(ConnectionInterface $con = null) Return the first ChildBoleta matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBoleta requireOneByIdboleta(int $idBoleta) Return the first ChildBoleta filtered by the idBoleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBoleta requireOneByIdusuario(int $idUsuario) Return the first ChildBoleta filtered by the idUsuario column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBoleta requireOneByIdsucursal(int $idSucursal) Return the first ChildBoleta filtered by the idSucursal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBoleta requireOneByFecha(string $fecha) Return the first ChildBoleta filtered by the fecha column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBoleta requireOneByTotal(int $total) Return the first ChildBoleta filtered by the total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBoleta[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBoleta objects based on current ModelCriteria
 * @method     ChildBoleta[]|ObjectCollection findByIdboleta(int $idBoleta) Return ChildBoleta objects filtered by the idBoleta column
 * @method     ChildBoleta[]|ObjectCollection findByIdusuario(int $idUsuario) Return ChildBoleta objects filtered by the idUsuario column
 * @method     ChildBoleta[]|ObjectCollection findByIdsucursal(int $idSucursal) Return ChildBoleta objects filtered by the idSucursal column
 * @method     ChildBoleta[]|ObjectCollection findByFecha(string $fecha) Return ChildBoleta objects filtered by the fecha column
 * @method     ChildBoleta[]|ObjectCollection findByTotal(int $total) Return ChildBoleta objects filtered by the total column
 * @method     ChildBoleta[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BoletaQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\BoletaQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Boleta', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBoletaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBoletaQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBoletaQuery) {
            return $criteria;
        }
        $query = new ChildBoletaQuery();
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
     * @return ChildBoleta|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BoletaTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BoletaTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBoleta A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idBoleta, idUsuario, idSucursal, fecha, total FROM boleta WHERE idBoleta = :p0';
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
            /** @var ChildBoleta $obj */
            $obj = new ChildBoleta();
            $obj->hydrate($row);
            BoletaTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBoleta|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idBoleta column
     *
     * Example usage:
     * <code>
     * $query->filterByIdboleta(1234); // WHERE idBoleta = 1234
     * $query->filterByIdboleta(array(12, 34)); // WHERE idBoleta IN (12, 34)
     * $query->filterByIdboleta(array('min' => 12)); // WHERE idBoleta > 12
     * </code>
     *
     * @param     mixed $idboleta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByIdboleta($idboleta = null, $comparison = null)
    {
        if (is_array($idboleta)) {
            $useMinMax = false;
            if (isset($idboleta['min'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $idboleta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idboleta['max'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $idboleta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $idboleta, $comparison);
    }

    /**
     * Filter the query on the idUsuario column
     *
     * Example usage:
     * <code>
     * $query->filterByIdusuario(1234); // WHERE idUsuario = 1234
     * $query->filterByIdusuario(array(12, 34)); // WHERE idUsuario IN (12, 34)
     * $query->filterByIdusuario(array('min' => 12)); // WHERE idUsuario > 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $idusuario The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByIdusuario($idusuario = null, $comparison = null)
    {
        if (is_array($idusuario)) {
            $useMinMax = false;
            if (isset($idusuario['min'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDUSUARIO, $idusuario['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idusuario['max'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDUSUARIO, $idusuario['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoletaTableMap::COL_IDUSUARIO, $idusuario, $comparison);
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
     * @see       filterBySucursal()
     *
     * @param     mixed $idsucursal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByIdsucursal($idsucursal = null, $comparison = null)
    {
        if (is_array($idsucursal)) {
            $useMinMax = false;
            if (isset($idsucursal['min'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDSUCURSAL, $idsucursal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idsucursal['max'])) {
                $this->addUsingAlias(BoletaTableMap::COL_IDSUCURSAL, $idsucursal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoletaTableMap::COL_IDSUCURSAL, $idsucursal, $comparison);
    }

    /**
     * Filter the query on the fecha column
     *
     * Example usage:
     * <code>
     * $query->filterByFecha('2011-03-14'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha('now'); // WHERE fecha = '2011-03-14'
     * $query->filterByFecha(array('max' => 'yesterday')); // WHERE fecha > '2011-03-13'
     * </code>
     *
     * @param     mixed $fecha The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByFecha($fecha = null, $comparison = null)
    {
        if (is_array($fecha)) {
            $useMinMax = false;
            if (isset($fecha['min'])) {
                $this->addUsingAlias(BoletaTableMap::COL_FECHA, $fecha['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fecha['max'])) {
                $this->addUsingAlias(BoletaTableMap::COL_FECHA, $fecha['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoletaTableMap::COL_FECHA, $fecha, $comparison);
    }

    /**
     * Filter the query on the total column
     *
     * Example usage:
     * <code>
     * $query->filterByTotal(1234); // WHERE total = 1234
     * $query->filterByTotal(array(12, 34)); // WHERE total IN (12, 34)
     * $query->filterByTotal(array('min' => 12)); // WHERE total > 12
     * </code>
     *
     * @param     mixed $total The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByTotal($total = null, $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(BoletaTableMap::COL_TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(BoletaTableMap::COL_TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BoletaTableMap::COL_TOTAL, $total, $comparison);
    }

    /**
     * Filter the query by a related \models\models\Usuario object
     *
     * @param \models\models\Usuario|ObjectCollection $usuario The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof \models\models\Usuario) {
            return $this
                ->addUsingAlias(BoletaTableMap::COL_IDUSUARIO, $usuario->getIdusuario(), $comparison);
        } elseif ($usuario instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoletaTableMap::COL_IDUSUARIO, $usuario->toKeyValue('PrimaryKey', 'Idusuario'), $comparison);
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type \models\models\Usuario or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

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
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\models\models\UsuarioQuery');
    }

    /**
     * Filter the query by a related \models\models\Sucursal object
     *
     * @param \models\models\Sucursal|ObjectCollection $sucursal The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBoletaQuery The current query, for fluid interface
     */
    public function filterBySucursal($sucursal, $comparison = null)
    {
        if ($sucursal instanceof \models\models\Sucursal) {
            return $this
                ->addUsingAlias(BoletaTableMap::COL_IDSUCURSAL, $sucursal->getIdsucursal(), $comparison);
        } elseif ($sucursal instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BoletaTableMap::COL_IDSUCURSAL, $sucursal->toKeyValue('PrimaryKey', 'Idsucursal'), $comparison);
        } else {
            throw new PropelException('filterBySucursal() only accepts arguments of type \models\models\Sucursal or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sucursal relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function joinSucursal($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sucursal');

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
            $this->addJoinObject($join, 'Sucursal');
        }

        return $this;
    }

    /**
     * Use the Sucursal relation Sucursal object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\SucursalQuery A secondary query class using the current class as primary query
     */
    public function useSucursalQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSucursal($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sucursal', '\models\models\SucursalQuery');
    }

    /**
     * Filter the query by a related \models\models\Detalle object
     *
     * @param \models\models\Detalle|ObjectCollection $detalle the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBoletaQuery The current query, for fluid interface
     */
    public function filterByDetalle($detalle, $comparison = null)
    {
        if ($detalle instanceof \models\models\Detalle) {
            return $this
                ->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $detalle->getIdboleta(), $comparison);
        } elseif ($detalle instanceof ObjectCollection) {
            return $this
                ->useDetalleQuery()
                ->filterByPrimaryKeys($detalle->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDetalle() only accepts arguments of type \models\models\Detalle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Detalle relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function joinDetalle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Detalle');

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
            $this->addJoinObject($join, 'Detalle');
        }

        return $this;
    }

    /**
     * Use the Detalle relation Detalle object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\DetalleQuery A secondary query class using the current class as primary query
     */
    public function useDetalleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDetalle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Detalle', '\models\models\DetalleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBoleta $boleta Object to remove from the list of results
     *
     * @return $this|ChildBoletaQuery The current query, for fluid interface
     */
    public function prune($boleta = null)
    {
        if ($boleta) {
            $this->addUsingAlias(BoletaTableMap::COL_IDBOLETA, $boleta->getIdboleta(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the boleta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BoletaTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BoletaTableMap::clearInstancePool();
            BoletaTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BoletaTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BoletaTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BoletaTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BoletaTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BoletaQuery
