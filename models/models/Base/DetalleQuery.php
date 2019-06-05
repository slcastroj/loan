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
use models\models\Detalle as ChildDetalle;
use models\models\DetalleQuery as ChildDetalleQuery;
use models\models\Map\DetalleTableMap;

/**
 * Base class that represents a query for the 'detalle' table.
 *
 *
 *
 * @method     ChildDetalleQuery orderByIddetalle($order = Criteria::ASC) Order by the idDetalle column
 * @method     ChildDetalleQuery orderByIdboleta($order = Criteria::ASC) Order by the idBoleta column
 * @method     ChildDetalleQuery orderByIdproducto($order = Criteria::ASC) Order by the idProducto column
 * @method     ChildDetalleQuery orderByCantidad($order = Criteria::ASC) Order by the cantidad column
 * @method     ChildDetalleQuery orderByPrecio($order = Criteria::ASC) Order by the precio column
 * @method     ChildDetalleQuery orderBySubtotal($order = Criteria::ASC) Order by the subTotal column
 *
 * @method     ChildDetalleQuery groupByIddetalle() Group by the idDetalle column
 * @method     ChildDetalleQuery groupByIdboleta() Group by the idBoleta column
 * @method     ChildDetalleQuery groupByIdproducto() Group by the idProducto column
 * @method     ChildDetalleQuery groupByCantidad() Group by the cantidad column
 * @method     ChildDetalleQuery groupByPrecio() Group by the precio column
 * @method     ChildDetalleQuery groupBySubtotal() Group by the subTotal column
 *
 * @method     ChildDetalleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDetalleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDetalleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDetalleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDetalleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDetalleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDetalleQuery leftJoinBoleta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Boleta relation
 * @method     ChildDetalleQuery rightJoinBoleta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Boleta relation
 * @method     ChildDetalleQuery innerJoinBoleta($relationAlias = null) Adds a INNER JOIN clause to the query using the Boleta relation
 *
 * @method     ChildDetalleQuery joinWithBoleta($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Boleta relation
 *
 * @method     ChildDetalleQuery leftJoinWithBoleta() Adds a LEFT JOIN clause and with to the query using the Boleta relation
 * @method     ChildDetalleQuery rightJoinWithBoleta() Adds a RIGHT JOIN clause and with to the query using the Boleta relation
 * @method     ChildDetalleQuery innerJoinWithBoleta() Adds a INNER JOIN clause and with to the query using the Boleta relation
 *
 * @method     ChildDetalleQuery leftJoinProducto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Producto relation
 * @method     ChildDetalleQuery rightJoinProducto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Producto relation
 * @method     ChildDetalleQuery innerJoinProducto($relationAlias = null) Adds a INNER JOIN clause to the query using the Producto relation
 *
 * @method     ChildDetalleQuery joinWithProducto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Producto relation
 *
 * @method     ChildDetalleQuery leftJoinWithProducto() Adds a LEFT JOIN clause and with to the query using the Producto relation
 * @method     ChildDetalleQuery rightJoinWithProducto() Adds a RIGHT JOIN clause and with to the query using the Producto relation
 * @method     ChildDetalleQuery innerJoinWithProducto() Adds a INNER JOIN clause and with to the query using the Producto relation
 *
 * @method     \models\models\BoletaQuery|\models\models\ProductoQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDetalle findOne(ConnectionInterface $con = null) Return the first ChildDetalle matching the query
 * @method     ChildDetalle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDetalle matching the query, or a new ChildDetalle object populated from the query conditions when no match is found
 *
 * @method     ChildDetalle findOneByIddetalle(int $idDetalle) Return the first ChildDetalle filtered by the idDetalle column
 * @method     ChildDetalle findOneByIdboleta(int $idBoleta) Return the first ChildDetalle filtered by the idBoleta column
 * @method     ChildDetalle findOneByIdproducto(int $idProducto) Return the first ChildDetalle filtered by the idProducto column
 * @method     ChildDetalle findOneByCantidad(int $cantidad) Return the first ChildDetalle filtered by the cantidad column
 * @method     ChildDetalle findOneByPrecio(int $precio) Return the first ChildDetalle filtered by the precio column
 * @method     ChildDetalle findOneBySubtotal(int $subTotal) Return the first ChildDetalle filtered by the subTotal column *

 * @method     ChildDetalle requirePk($key, ConnectionInterface $con = null) Return the ChildDetalle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOne(ConnectionInterface $con = null) Return the first ChildDetalle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetalle requireOneByIddetalle(int $idDetalle) Return the first ChildDetalle filtered by the idDetalle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOneByIdboleta(int $idBoleta) Return the first ChildDetalle filtered by the idBoleta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOneByIdproducto(int $idProducto) Return the first ChildDetalle filtered by the idProducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOneByCantidad(int $cantidad) Return the first ChildDetalle filtered by the cantidad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOneByPrecio(int $precio) Return the first ChildDetalle filtered by the precio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDetalle requireOneBySubtotal(int $subTotal) Return the first ChildDetalle filtered by the subTotal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDetalle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDetalle objects based on current ModelCriteria
 * @method     ChildDetalle[]|ObjectCollection findByIddetalle(int $idDetalle) Return ChildDetalle objects filtered by the idDetalle column
 * @method     ChildDetalle[]|ObjectCollection findByIdboleta(int $idBoleta) Return ChildDetalle objects filtered by the idBoleta column
 * @method     ChildDetalle[]|ObjectCollection findByIdproducto(int $idProducto) Return ChildDetalle objects filtered by the idProducto column
 * @method     ChildDetalle[]|ObjectCollection findByCantidad(int $cantidad) Return ChildDetalle objects filtered by the cantidad column
 * @method     ChildDetalle[]|ObjectCollection findByPrecio(int $precio) Return ChildDetalle objects filtered by the precio column
 * @method     ChildDetalle[]|ObjectCollection findBySubtotal(int $subTotal) Return ChildDetalle objects filtered by the subTotal column
 * @method     ChildDetalle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DetalleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\DetalleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Detalle', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDetalleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDetalleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDetalleQuery) {
            return $criteria;
        }
        $query = new ChildDetalleQuery();
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
     * @return ChildDetalle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DetalleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DetalleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDetalle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idDetalle, idBoleta, idProducto, cantidad, precio, subTotal FROM detalle WHERE idDetalle = :p0';
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
            /** @var ChildDetalle $obj */
            $obj = new ChildDetalle();
            $obj->hydrate($row);
            DetalleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDetalle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the idDetalle column
     *
     * Example usage:
     * <code>
     * $query->filterByIddetalle(1234); // WHERE idDetalle = 1234
     * $query->filterByIddetalle(array(12, 34)); // WHERE idDetalle IN (12, 34)
     * $query->filterByIddetalle(array('min' => 12)); // WHERE idDetalle > 12
     * </code>
     *
     * @param     mixed $iddetalle The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByIddetalle($iddetalle = null, $comparison = null)
    {
        if (is_array($iddetalle)) {
            $useMinMax = false;
            if (isset($iddetalle['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $iddetalle['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($iddetalle['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $iddetalle['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $iddetalle, $comparison);
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
     * @see       filterByBoleta()
     *
     * @param     mixed $idboleta The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByIdboleta($idboleta = null, $comparison = null)
    {
        if (is_array($idboleta)) {
            $useMinMax = false;
            if (isset($idboleta['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDBOLETA, $idboleta['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idboleta['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDBOLETA, $idboleta['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_IDBOLETA, $idboleta, $comparison);
    }

    /**
     * Filter the query on the idProducto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdproducto(1234); // WHERE idProducto = 1234
     * $query->filterByIdproducto(array(12, 34)); // WHERE idProducto IN (12, 34)
     * $query->filterByIdproducto(array('min' => 12)); // WHERE idProducto > 12
     * </code>
     *
     * @see       filterByProducto()
     *
     * @param     mixed $idproducto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
    }

    /**
     * Filter the query on the cantidad column
     *
     * Example usage:
     * <code>
     * $query->filterByCantidad(1234); // WHERE cantidad = 1234
     * $query->filterByCantidad(array(12, 34)); // WHERE cantidad IN (12, 34)
     * $query->filterByCantidad(array('min' => 12)); // WHERE cantidad > 12
     * </code>
     *
     * @param     mixed $cantidad The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByCantidad($cantidad = null, $comparison = null)
    {
        if (is_array($cantidad)) {
            $useMinMax = false;
            if (isset($cantidad['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_CANTIDAD, $cantidad['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($cantidad['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_CANTIDAD, $cantidad['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_CANTIDAD, $cantidad, $comparison);
    }

    /**
     * Filter the query on the precio column
     *
     * Example usage:
     * <code>
     * $query->filterByPrecio(1234); // WHERE precio = 1234
     * $query->filterByPrecio(array(12, 34)); // WHERE precio IN (12, 34)
     * $query->filterByPrecio(array('min' => 12)); // WHERE precio > 12
     * </code>
     *
     * @param     mixed $precio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByPrecio($precio = null, $comparison = null)
    {
        if (is_array($precio)) {
            $useMinMax = false;
            if (isset($precio['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_PRECIO, $precio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precio['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_PRECIO, $precio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_PRECIO, $precio, $comparison);
    }

    /**
     * Filter the query on the subTotal column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtotal(1234); // WHERE subTotal = 1234
     * $query->filterBySubtotal(array(12, 34)); // WHERE subTotal IN (12, 34)
     * $query->filterBySubtotal(array('min' => 12)); // WHERE subTotal > 12
     * </code>
     *
     * @param     mixed $subtotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function filterBySubtotal($subtotal = null, $comparison = null)
    {
        if (is_array($subtotal)) {
            $useMinMax = false;
            if (isset($subtotal['min'])) {
                $this->addUsingAlias(DetalleTableMap::COL_SUBTOTAL, $subtotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subtotal['max'])) {
                $this->addUsingAlias(DetalleTableMap::COL_SUBTOTAL, $subtotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DetalleTableMap::COL_SUBTOTAL, $subtotal, $comparison);
    }

    /**
     * Filter the query by a related \models\models\Boleta object
     *
     * @param \models\models\Boleta|ObjectCollection $boleta The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByBoleta($boleta, $comparison = null)
    {
        if ($boleta instanceof \models\models\Boleta) {
            return $this
                ->addUsingAlias(DetalleTableMap::COL_IDBOLETA, $boleta->getIdboleta(), $comparison);
        } elseif ($boleta instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetalleTableMap::COL_IDBOLETA, $boleta->toKeyValue('PrimaryKey', 'Idboleta'), $comparison);
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
     * @return $this|ChildDetalleQuery The current query, for fluid interface
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
     * Filter the query by a related \models\models\Producto object
     *
     * @param \models\models\Producto|ObjectCollection $producto The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDetalleQuery The current query, for fluid interface
     */
    public function filterByProducto($producto, $comparison = null)
    {
        if ($producto instanceof \models\models\Producto) {
            return $this
                ->addUsingAlias(DetalleTableMap::COL_IDPRODUCTO, $producto->getIdproducto(), $comparison);
        } elseif ($producto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DetalleTableMap::COL_IDPRODUCTO, $producto->toKeyValue('PrimaryKey', 'Idproducto'), $comparison);
        } else {
            throw new PropelException('filterByProducto() only accepts arguments of type \models\models\Producto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Producto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function joinProducto($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Producto');

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
            $this->addJoinObject($join, 'Producto');
        }

        return $this;
    }

    /**
     * Use the Producto relation Producto object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\ProductoQuery A secondary query class using the current class as primary query
     */
    public function useProductoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProducto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Producto', '\models\models\ProductoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildDetalle $detalle Object to remove from the list of results
     *
     * @return $this|ChildDetalleQuery The current query, for fluid interface
     */
    public function prune($detalle = null)
    {
        if ($detalle) {
            $this->addUsingAlias(DetalleTableMap::COL_IDDETALLE, $detalle->getIddetalle(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the detalle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetalleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DetalleTableMap::clearInstancePool();
            DetalleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DetalleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DetalleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DetalleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DetalleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DetalleQuery
