<?php

namespace models\models\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use models\models\Producto;
use models\models\ProductoQuery;


/**
 * This class defines the structure of the 'producto' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class ProductoTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.ProductoTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'producto';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\Producto';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.Producto';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the idProducto field
     */
    const COL_IDPRODUCTO = 'producto.idProducto';

    /**
     * the column name for the idMarca field
     */
    const COL_IDMARCA = 'producto.idMarca';

    /**
     * the column name for the idProveedor field
     */
    const COL_IDPROVEEDOR = 'producto.idProveedor';

    /**
     * the column name for the idTipoProducto field
     */
    const COL_IDTIPOPRODUCTO = 'producto.idTipoProducto';

    /**
     * the column name for the nombreProducto field
     */
    const COL_NOMBREPRODUCTO = 'producto.nombreProducto';

    /**
     * the column name for the codigo field
     */
    const COL_CODIGO = 'producto.codigo';

    /**
     * the column name for the descripcion field
     */
    const COL_DESCRIPCION = 'producto.descripcion';

    /**
     * the column name for the stock field
     */
    const COL_STOCK = 'producto.stock';

    /**
     * the column name for the stockMinimo field
     */
    const COL_STOCKMINIMO = 'producto.stockMinimo';

    /**
     * the column name for the precio field
     */
    const COL_PRECIO = 'producto.precio';

    /**
     * the column name for the activo field
     */
    const COL_ACTIVO = 'producto.activo';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Idproducto', 'Idmarca', 'Idproveedor', 'Idtipoproducto', 'Nombreproducto', 'Codigo', 'Descripcion', 'Stock', 'Stockminimo', 'Precio', 'Activo', ),
        self::TYPE_CAMELNAME     => array('idproducto', 'idmarca', 'idproveedor', 'idtipoproducto', 'nombreproducto', 'codigo', 'descripcion', 'stock', 'stockminimo', 'precio', 'activo', ),
        self::TYPE_COLNAME       => array(ProductoTableMap::COL_IDPRODUCTO, ProductoTableMap::COL_IDMARCA, ProductoTableMap::COL_IDPROVEEDOR, ProductoTableMap::COL_IDTIPOPRODUCTO, ProductoTableMap::COL_NOMBREPRODUCTO, ProductoTableMap::COL_CODIGO, ProductoTableMap::COL_DESCRIPCION, ProductoTableMap::COL_STOCK, ProductoTableMap::COL_STOCKMINIMO, ProductoTableMap::COL_PRECIO, ProductoTableMap::COL_ACTIVO, ),
        self::TYPE_FIELDNAME     => array('idProducto', 'idMarca', 'idProveedor', 'idTipoProducto', 'nombreProducto', 'codigo', 'descripcion', 'stock', 'stockMinimo', 'precio', 'activo', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idproducto' => 0, 'Idmarca' => 1, 'Idproveedor' => 2, 'Idtipoproducto' => 3, 'Nombreproducto' => 4, 'Codigo' => 5, 'Descripcion' => 6, 'Stock' => 7, 'Stockminimo' => 8, 'Precio' => 9, 'Activo' => 10, ),
        self::TYPE_CAMELNAME     => array('idproducto' => 0, 'idmarca' => 1, 'idproveedor' => 2, 'idtipoproducto' => 3, 'nombreproducto' => 4, 'codigo' => 5, 'descripcion' => 6, 'stock' => 7, 'stockminimo' => 8, 'precio' => 9, 'activo' => 10, ),
        self::TYPE_COLNAME       => array(ProductoTableMap::COL_IDPRODUCTO => 0, ProductoTableMap::COL_IDMARCA => 1, ProductoTableMap::COL_IDPROVEEDOR => 2, ProductoTableMap::COL_IDTIPOPRODUCTO => 3, ProductoTableMap::COL_NOMBREPRODUCTO => 4, ProductoTableMap::COL_CODIGO => 5, ProductoTableMap::COL_DESCRIPCION => 6, ProductoTableMap::COL_STOCK => 7, ProductoTableMap::COL_STOCKMINIMO => 8, ProductoTableMap::COL_PRECIO => 9, ProductoTableMap::COL_ACTIVO => 10, ),
        self::TYPE_FIELDNAME     => array('idProducto' => 0, 'idMarca' => 1, 'idProveedor' => 2, 'idTipoProducto' => 3, 'nombreProducto' => 4, 'codigo' => 5, 'descripcion' => 6, 'stock' => 7, 'stockMinimo' => 8, 'precio' => 9, 'activo' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('producto');
        $this->setPhpName('Producto');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\Producto');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idProducto', 'Idproducto', 'INTEGER', true, null, null);
        $this->addForeignKey('idMarca', 'Idmarca', 'INTEGER', 'marca', 'idMarca', true, null, null);
        $this->addForeignKey('idProveedor', 'Idproveedor', 'INTEGER', 'proveedor', 'idProveedor', true, null, null);
        $this->addForeignKey('idTipoProducto', 'Idtipoproducto', 'INTEGER', 'tipoproducto', 'idTipoProducto', true, null, null);
        $this->addColumn('nombreProducto', 'Nombreproducto', 'VARCHAR', true, 200, null);
        $this->addColumn('codigo', 'Codigo', 'INTEGER', true, null, null);
        $this->addColumn('descripcion', 'Descripcion', 'VARCHAR', true, 2000, null);
        $this->addColumn('stock', 'Stock', 'INTEGER', true, null, null);
        $this->addColumn('stockMinimo', 'Stockminimo', 'INTEGER', true, null, null);
        $this->addColumn('precio', 'Precio', 'INTEGER', true, null, null);
        $this->addColumn('activo', 'Activo', 'TINYINT', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Marca', '\\models\\models\\Marca', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idMarca',
    1 => ':idMarca',
  ),
), null, null, null, false);
        $this->addRelation('Proveedor', '\\models\\models\\Proveedor', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idProveedor',
    1 => ':idProveedor',
  ),
), null, null, null, false);
        $this->addRelation('Tipoproducto', '\\models\\models\\Tipoproducto', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idTipoProducto',
    1 => ':idTipoProducto',
  ),
), null, null, null, false);
        $this->addRelation('Detalle', '\\models\\models\\Detalle', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idProducto',
    1 => ':idProducto',
  ),
), null, null, 'Detalles', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ProductoTableMap::CLASS_DEFAULT : ProductoTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Producto object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ProductoTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ProductoTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ProductoTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ProductoTableMap::OM_CLASS;
            /** @var Producto $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ProductoTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ProductoTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ProductoTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Producto $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ProductoTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ProductoTableMap::COL_IDPRODUCTO);
            $criteria->addSelectColumn(ProductoTableMap::COL_IDMARCA);
            $criteria->addSelectColumn(ProductoTableMap::COL_IDPROVEEDOR);
            $criteria->addSelectColumn(ProductoTableMap::COL_IDTIPOPRODUCTO);
            $criteria->addSelectColumn(ProductoTableMap::COL_NOMBREPRODUCTO);
            $criteria->addSelectColumn(ProductoTableMap::COL_CODIGO);
            $criteria->addSelectColumn(ProductoTableMap::COL_DESCRIPCION);
            $criteria->addSelectColumn(ProductoTableMap::COL_STOCK);
            $criteria->addSelectColumn(ProductoTableMap::COL_STOCKMINIMO);
            $criteria->addSelectColumn(ProductoTableMap::COL_PRECIO);
            $criteria->addSelectColumn(ProductoTableMap::COL_ACTIVO);
        } else {
            $criteria->addSelectColumn($alias . '.idProducto');
            $criteria->addSelectColumn($alias . '.idMarca');
            $criteria->addSelectColumn($alias . '.idProveedor');
            $criteria->addSelectColumn($alias . '.idTipoProducto');
            $criteria->addSelectColumn($alias . '.nombreProducto');
            $criteria->addSelectColumn($alias . '.codigo');
            $criteria->addSelectColumn($alias . '.descripcion');
            $criteria->addSelectColumn($alias . '.stock');
            $criteria->addSelectColumn($alias . '.stockMinimo');
            $criteria->addSelectColumn($alias . '.precio');
            $criteria->addSelectColumn($alias . '.activo');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ProductoTableMap::DATABASE_NAME)->getTable(ProductoTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ProductoTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ProductoTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ProductoTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Producto or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Producto object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\Producto) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ProductoTableMap::DATABASE_NAME);
            $criteria->add(ProductoTableMap::COL_IDPRODUCTO, (array) $values, Criteria::IN);
        }

        $query = ProductoQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ProductoTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ProductoTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the producto table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ProductoQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Producto or Criteria object.
     *
     * @param mixed               $criteria Criteria or Producto object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Producto object
        }

        if ($criteria->containsKey(ProductoTableMap::COL_IDPRODUCTO) && $criteria->keyContainsValue(ProductoTableMap::COL_IDPRODUCTO) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ProductoTableMap::COL_IDPRODUCTO.')');
        }


        // Set the correct dbName
        $query = ProductoQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ProductoTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ProductoTableMap::buildTableMap();
