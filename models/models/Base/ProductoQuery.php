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
use models\models\Producto as ChildProducto;
use models\models\ProductoQuery as ChildProductoQuery;
use models\models\Map\ProductoTableMap;

/**
 * Base class that represents a query for the 'producto' table.
 *
 *
 *
 * @method     ChildProductoQuery orderByIdproducto($order = Criteria::ASC) Order by the idProducto column
 * @method     ChildProductoQuery orderByIdmarca($order = Criteria::ASC) Order by the idMarca column
 * @method     ChildProductoQuery orderByIdproveedor($order = Criteria::ASC) Order by the idProveedor column
 * @method     ChildProductoQuery orderByIdtipoproducto($order = Criteria::ASC) Order by the idTipoProducto column
 * @method     ChildProductoQuery orderByNombreproducto($order = Criteria::ASC) Order by the nombreProducto column
 * @method     ChildProductoQuery orderByCodigo($order = Criteria::ASC) Order by the codigo column
 * @method     ChildProductoQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method     ChildProductoQuery orderByStock($order = Criteria::ASC) Order by the stock column
 * @method     ChildProductoQuery orderByStockminimo($order = Criteria::ASC) Order by the stockMinimo column
 * @method     ChildProductoQuery orderByPrecio($order = Criteria::ASC) Order by the precio column
 * @method     ChildProductoQuery orderByActivo($order = Criteria::ASC) Order by the activo column
 *
 * @method     ChildProductoQuery groupByIdproducto() Group by the idProducto column
 * @method     ChildProductoQuery groupByIdmarca() Group by the idMarca column
 * @method     ChildProductoQuery groupByIdproveedor() Group by the idProveedor column
 * @method     ChildProductoQuery groupByIdtipoproducto() Group by the idTipoProducto column
 * @method     ChildProductoQuery groupByNombreproducto() Group by the nombreProducto column
 * @method     ChildProductoQuery groupByCodigo() Group by the codigo column
 * @method     ChildProductoQuery groupByDescripcion() Group by the descripcion column
 * @method     ChildProductoQuery groupByStock() Group by the stock column
 * @method     ChildProductoQuery groupByStockminimo() Group by the stockMinimo column
 * @method     ChildProductoQuery groupByPrecio() Group by the precio column
 * @method     ChildProductoQuery groupByActivo() Group by the activo column
 *
 * @method     ChildProductoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProductoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProductoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProductoQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProductoQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProductoQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProductoQuery leftJoinMarca($relationAlias = null) Adds a LEFT JOIN clause to the query using the Marca relation
 * @method     ChildProductoQuery rightJoinMarca($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Marca relation
 * @method     ChildProductoQuery innerJoinMarca($relationAlias = null) Adds a INNER JOIN clause to the query using the Marca relation
 *
 * @method     ChildProductoQuery joinWithMarca($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Marca relation
 *
 * @method     ChildProductoQuery leftJoinWithMarca() Adds a LEFT JOIN clause and with to the query using the Marca relation
 * @method     ChildProductoQuery rightJoinWithMarca() Adds a RIGHT JOIN clause and with to the query using the Marca relation
 * @method     ChildProductoQuery innerJoinWithMarca() Adds a INNER JOIN clause and with to the query using the Marca relation
 *
 * @method     ChildProductoQuery leftJoinProveedor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Proveedor relation
 * @method     ChildProductoQuery rightJoinProveedor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Proveedor relation
 * @method     ChildProductoQuery innerJoinProveedor($relationAlias = null) Adds a INNER JOIN clause to the query using the Proveedor relation
 *
 * @method     ChildProductoQuery joinWithProveedor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Proveedor relation
 *
 * @method     ChildProductoQuery leftJoinWithProveedor() Adds a LEFT JOIN clause and with to the query using the Proveedor relation
 * @method     ChildProductoQuery rightJoinWithProveedor() Adds a RIGHT JOIN clause and with to the query using the Proveedor relation
 * @method     ChildProductoQuery innerJoinWithProveedor() Adds a INNER JOIN clause and with to the query using the Proveedor relation
 *
 * @method     ChildProductoQuery leftJoinTipoproducto($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tipoproducto relation
 * @method     ChildProductoQuery rightJoinTipoproducto($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tipoproducto relation
 * @method     ChildProductoQuery innerJoinTipoproducto($relationAlias = null) Adds a INNER JOIN clause to the query using the Tipoproducto relation
 *
 * @method     ChildProductoQuery joinWithTipoproducto($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tipoproducto relation
 *
 * @method     ChildProductoQuery leftJoinWithTipoproducto() Adds a LEFT JOIN clause and with to the query using the Tipoproducto relation
 * @method     ChildProductoQuery rightJoinWithTipoproducto() Adds a RIGHT JOIN clause and with to the query using the Tipoproducto relation
 * @method     ChildProductoQuery innerJoinWithTipoproducto() Adds a INNER JOIN clause and with to the query using the Tipoproducto relation
 *
 * @method     ChildProductoQuery leftJoinDetalle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Detalle relation
 * @method     ChildProductoQuery rightJoinDetalle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Detalle relation
 * @method     ChildProductoQuery innerJoinDetalle($relationAlias = null) Adds a INNER JOIN clause to the query using the Detalle relation
 *
 * @method     ChildProductoQuery joinWithDetalle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Detalle relation
 *
 * @method     ChildProductoQuery leftJoinWithDetalle() Adds a LEFT JOIN clause and with to the query using the Detalle relation
 * @method     ChildProductoQuery rightJoinWithDetalle() Adds a RIGHT JOIN clause and with to the query using the Detalle relation
 * @method     ChildProductoQuery innerJoinWithDetalle() Adds a INNER JOIN clause and with to the query using the Detalle relation
 *
 * @method     \models\models\MarcaQuery|\models\models\ProveedorQuery|\models\models\TipoproductoQuery|\models\models\DetalleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProducto findOne(ConnectionInterface $con = null) Return the first ChildProducto matching the query
 * @method     ChildProducto findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProducto matching the query, or a new ChildProducto object populated from the query conditions when no match is found
 *
 * @method     ChildProducto findOneByIdproducto(int $idProducto) Return the first ChildProducto filtered by the idProducto column
 * @method     ChildProducto findOneByIdmarca(int $idMarca) Return the first ChildProducto filtered by the idMarca column
 * @method     ChildProducto findOneByIdproveedor(int $idProveedor) Return the first ChildProducto filtered by the idProveedor column
 * @method     ChildProducto findOneByIdtipoproducto(int $idTipoProducto) Return the first ChildProducto filtered by the idTipoProducto column
 * @method     ChildProducto findOneByNombreproducto(string $nombreProducto) Return the first ChildProducto filtered by the nombreProducto column
 * @method     ChildProducto findOneByCodigo(int $codigo) Return the first ChildProducto filtered by the codigo column
 * @method     ChildProducto findOneByDescripcion(string $descripcion) Return the first ChildProducto filtered by the descripcion column
 * @method     ChildProducto findOneByStock(int $stock) Return the first ChildProducto filtered by the stock column
 * @method     ChildProducto findOneByStockminimo(int $stockMinimo) Return the first ChildProducto filtered by the stockMinimo column
 * @method     ChildProducto findOneByPrecio(int $precio) Return the first ChildProducto filtered by the precio column
 * @method     ChildProducto findOneByActivo(int $activo) Return the first ChildProducto filtered by the activo column *

 * @method     ChildProducto requirePk($key, ConnectionInterface $con = null) Return the ChildProducto by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOne(ConnectionInterface $con = null) Return the first ChildProducto matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducto requireOneByIdproducto(int $idProducto) Return the first ChildProducto filtered by the idProducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByIdmarca(int $idMarca) Return the first ChildProducto filtered by the idMarca column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByIdproveedor(int $idProveedor) Return the first ChildProducto filtered by the idProveedor column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByIdtipoproducto(int $idTipoProducto) Return the first ChildProducto filtered by the idTipoProducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByNombreproducto(string $nombreProducto) Return the first ChildProducto filtered by the nombreProducto column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByCodigo(int $codigo) Return the first ChildProducto filtered by the codigo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByDescripcion(string $descripcion) Return the first ChildProducto filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByStock(int $stock) Return the first ChildProducto filtered by the stock column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByStockminimo(int $stockMinimo) Return the first ChildProducto filtered by the stockMinimo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByPrecio(int $precio) Return the first ChildProducto filtered by the precio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProducto requireOneByActivo(int $activo) Return the first ChildProducto filtered by the activo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProducto[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProducto objects based on current ModelCriteria
 * @method     ChildProducto[]|ObjectCollection findByIdproducto(int $idProducto) Return ChildProducto objects filtered by the idProducto column
 * @method     ChildProducto[]|ObjectCollection findByIdmarca(int $idMarca) Return ChildProducto objects filtered by the idMarca column
 * @method     ChildProducto[]|ObjectCollection findByIdproveedor(int $idProveedor) Return ChildProducto objects filtered by the idProveedor column
 * @method     ChildProducto[]|ObjectCollection findByIdtipoproducto(int $idTipoProducto) Return ChildProducto objects filtered by the idTipoProducto column
 * @method     ChildProducto[]|ObjectCollection findByNombreproducto(string $nombreProducto) Return ChildProducto objects filtered by the nombreProducto column
 * @method     ChildProducto[]|ObjectCollection findByCodigo(int $codigo) Return ChildProducto objects filtered by the codigo column
 * @method     ChildProducto[]|ObjectCollection findByDescripcion(string $descripcion) Return ChildProducto objects filtered by the descripcion column
 * @method     ChildProducto[]|ObjectCollection findByStock(int $stock) Return ChildProducto objects filtered by the stock column
 * @method     ChildProducto[]|ObjectCollection findByStockminimo(int $stockMinimo) Return ChildProducto objects filtered by the stockMinimo column
 * @method     ChildProducto[]|ObjectCollection findByPrecio(int $precio) Return ChildProducto objects filtered by the precio column
 * @method     ChildProducto[]|ObjectCollection findByActivo(int $activo) Return ChildProducto objects filtered by the activo column
 * @method     ChildProducto[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProductoQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \models\models\Base\ProductoQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\models\\models\\Producto', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProductoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProductoQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProductoQuery) {
            return $criteria;
        }
        $query = new ChildProductoQuery();
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
     * @return ChildProducto|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductoTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProductoTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProducto A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT idProducto, idMarca, idProveedor, idTipoProducto, nombreProducto, codigo, descripcion, stock, stockMinimo, precio, activo FROM producto WHERE idProducto = :p0';
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
            /** @var ChildProducto $obj */
            $obj = new ChildProducto();
            $obj->hydrate($row);
            ProductoTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProducto|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $keys, Criteria::IN);
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
     * @param     mixed $idproducto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByIdproducto($idproducto = null, $comparison = null)
    {
        if (is_array($idproducto)) {
            $useMinMax = false;
            if (isset($idproducto['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $idproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproducto['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $idproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $idproducto, $comparison);
    }

    /**
     * Filter the query on the idMarca column
     *
     * Example usage:
     * <code>
     * $query->filterByIdmarca(1234); // WHERE idMarca = 1234
     * $query->filterByIdmarca(array(12, 34)); // WHERE idMarca IN (12, 34)
     * $query->filterByIdmarca(array('min' => 12)); // WHERE idMarca > 12
     * </code>
     *
     * @see       filterByMarca()
     *
     * @param     mixed $idmarca The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByIdmarca($idmarca = null, $comparison = null)
    {
        if (is_array($idmarca)) {
            $useMinMax = false;
            if (isset($idmarca['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDMARCA, $idmarca['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idmarca['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDMARCA, $idmarca['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_IDMARCA, $idmarca, $comparison);
    }

    /**
     * Filter the query on the idProveedor column
     *
     * Example usage:
     * <code>
     * $query->filterByIdproveedor(1234); // WHERE idProveedor = 1234
     * $query->filterByIdproveedor(array(12, 34)); // WHERE idProveedor IN (12, 34)
     * $query->filterByIdproveedor(array('min' => 12)); // WHERE idProveedor > 12
     * </code>
     *
     * @see       filterByProveedor()
     *
     * @param     mixed $idproveedor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByIdproveedor($idproveedor = null, $comparison = null)
    {
        if (is_array($idproveedor)) {
            $useMinMax = false;
            if (isset($idproveedor['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDPROVEEDOR, $idproveedor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idproveedor['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDPROVEEDOR, $idproveedor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_IDPROVEEDOR, $idproveedor, $comparison);
    }

    /**
     * Filter the query on the idTipoProducto column
     *
     * Example usage:
     * <code>
     * $query->filterByIdtipoproducto(1234); // WHERE idTipoProducto = 1234
     * $query->filterByIdtipoproducto(array(12, 34)); // WHERE idTipoProducto IN (12, 34)
     * $query->filterByIdtipoproducto(array('min' => 12)); // WHERE idTipoProducto > 12
     * </code>
     *
     * @see       filterByTipoproducto()
     *
     * @param     mixed $idtipoproducto The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByIdtipoproducto($idtipoproducto = null, $comparison = null)
    {
        if (is_array($idtipoproducto)) {
            $useMinMax = false;
            if (isset($idtipoproducto['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDTIPOPRODUCTO, $idtipoproducto['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idtipoproducto['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_IDTIPOPRODUCTO, $idtipoproducto['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_IDTIPOPRODUCTO, $idtipoproducto, $comparison);
    }

    /**
     * Filter the query on the nombreProducto column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreproducto('fooValue');   // WHERE nombreProducto = 'fooValue'
     * $query->filterByNombreproducto('%fooValue%', Criteria::LIKE); // WHERE nombreProducto LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreproducto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByNombreproducto($nombreproducto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreproducto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_NOMBREPRODUCTO, $nombreproducto, $comparison);
    }

    /**
     * Filter the query on the codigo column
     *
     * Example usage:
     * <code>
     * $query->filterByCodigo(1234); // WHERE codigo = 1234
     * $query->filterByCodigo(array(12, 34)); // WHERE codigo IN (12, 34)
     * $query->filterByCodigo(array('min' => 12)); // WHERE codigo > 12
     * </code>
     *
     * @param     mixed $codigo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByCodigo($codigo = null, $comparison = null)
    {
        if (is_array($codigo)) {
            $useMinMax = false;
            if (isset($codigo['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_CODIGO, $codigo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($codigo['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_CODIGO, $codigo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_CODIGO, $codigo, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%', Criteria::LIKE); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the stock column
     *
     * Example usage:
     * <code>
     * $query->filterByStock(1234); // WHERE stock = 1234
     * $query->filterByStock(array(12, 34)); // WHERE stock IN (12, 34)
     * $query->filterByStock(array('min' => 12)); // WHERE stock > 12
     * </code>
     *
     * @param     mixed $stock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByStock($stock = null, $comparison = null)
    {
        if (is_array($stock)) {
            $useMinMax = false;
            if (isset($stock['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_STOCK, $stock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stock['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_STOCK, $stock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_STOCK, $stock, $comparison);
    }

    /**
     * Filter the query on the stockMinimo column
     *
     * Example usage:
     * <code>
     * $query->filterByStockminimo(1234); // WHERE stockMinimo = 1234
     * $query->filterByStockminimo(array(12, 34)); // WHERE stockMinimo IN (12, 34)
     * $query->filterByStockminimo(array('min' => 12)); // WHERE stockMinimo > 12
     * </code>
     *
     * @param     mixed $stockminimo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByStockminimo($stockminimo = null, $comparison = null)
    {
        if (is_array($stockminimo)) {
            $useMinMax = false;
            if (isset($stockminimo['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_STOCKMINIMO, $stockminimo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($stockminimo['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_STOCKMINIMO, $stockminimo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_STOCKMINIMO, $stockminimo, $comparison);
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
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByPrecio($precio = null, $comparison = null)
    {
        if (is_array($precio)) {
            $useMinMax = false;
            if (isset($precio['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO, $precio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($precio['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_PRECIO, $precio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_PRECIO, $precio, $comparison);
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
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function filterByActivo($activo = null, $comparison = null)
    {
        if (is_array($activo)) {
            $useMinMax = false;
            if (isset($activo['min'])) {
                $this->addUsingAlias(ProductoTableMap::COL_ACTIVO, $activo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($activo['max'])) {
                $this->addUsingAlias(ProductoTableMap::COL_ACTIVO, $activo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProductoTableMap::COL_ACTIVO, $activo, $comparison);
    }

    /**
     * Filter the query by a related \models\models\Marca object
     *
     * @param \models\models\Marca|ObjectCollection $marca The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductoQuery The current query, for fluid interface
     */
    public function filterByMarca($marca, $comparison = null)
    {
        if ($marca instanceof \models\models\Marca) {
            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDMARCA, $marca->getIdmarca(), $comparison);
        } elseif ($marca instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDMARCA, $marca->toKeyValue('PrimaryKey', 'Idmarca'), $comparison);
        } else {
            throw new PropelException('filterByMarca() only accepts arguments of type \models\models\Marca or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Marca relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function joinMarca($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Marca');

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
            $this->addJoinObject($join, 'Marca');
        }

        return $this;
    }

    /**
     * Use the Marca relation Marca object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\MarcaQuery A secondary query class using the current class as primary query
     */
    public function useMarcaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinMarca($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Marca', '\models\models\MarcaQuery');
    }

    /**
     * Filter the query by a related \models\models\Proveedor object
     *
     * @param \models\models\Proveedor|ObjectCollection $proveedor The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductoQuery The current query, for fluid interface
     */
    public function filterByProveedor($proveedor, $comparison = null)
    {
        if ($proveedor instanceof \models\models\Proveedor) {
            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDPROVEEDOR, $proveedor->getIdproveedor(), $comparison);
        } elseif ($proveedor instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDPROVEEDOR, $proveedor->toKeyValue('PrimaryKey', 'Idproveedor'), $comparison);
        } else {
            throw new PropelException('filterByProveedor() only accepts arguments of type \models\models\Proveedor or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Proveedor relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function joinProveedor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Proveedor');

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
            $this->addJoinObject($join, 'Proveedor');
        }

        return $this;
    }

    /**
     * Use the Proveedor relation Proveedor object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\ProveedorQuery A secondary query class using the current class as primary query
     */
    public function useProveedorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProveedor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Proveedor', '\models\models\ProveedorQuery');
    }

    /**
     * Filter the query by a related \models\models\Tipoproducto object
     *
     * @param \models\models\Tipoproducto|ObjectCollection $tipoproducto The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProductoQuery The current query, for fluid interface
     */
    public function filterByTipoproducto($tipoproducto, $comparison = null)
    {
        if ($tipoproducto instanceof \models\models\Tipoproducto) {
            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDTIPOPRODUCTO, $tipoproducto->getIdtipoproducto(), $comparison);
        } elseif ($tipoproducto instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDTIPOPRODUCTO, $tipoproducto->toKeyValue('PrimaryKey', 'Idtipoproducto'), $comparison);
        } else {
            throw new PropelException('filterByTipoproducto() only accepts arguments of type \models\models\Tipoproducto or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tipoproducto relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function joinTipoproducto($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tipoproducto');

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
            $this->addJoinObject($join, 'Tipoproducto');
        }

        return $this;
    }

    /**
     * Use the Tipoproducto relation Tipoproducto object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \models\models\TipoproductoQuery A secondary query class using the current class as primary query
     */
    public function useTipoproductoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTipoproducto($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tipoproducto', '\models\models\TipoproductoQuery');
    }

    /**
     * Filter the query by a related \models\models\Detalle object
     *
     * @param \models\models\Detalle|ObjectCollection $detalle the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildProductoQuery The current query, for fluid interface
     */
    public function filterByDetalle($detalle, $comparison = null)
    {
        if ($detalle instanceof \models\models\Detalle) {
            return $this
                ->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $detalle->getIdproducto(), $comparison);
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
     * @return $this|ChildProductoQuery The current query, for fluid interface
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
     * @param   ChildProducto $producto Object to remove from the list of results
     *
     * @return $this|ChildProductoQuery The current query, for fluid interface
     */
    public function prune($producto = null)
    {
        if ($producto) {
            $this->addUsingAlias(ProductoTableMap::COL_IDPRODUCTO, $producto->getIdproducto(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProductoTableMap::clearInstancePool();
            ProductoTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProductoTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProductoTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProductoTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProductoQuery
