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
use models\models\Detalle;
use models\models\DetalleQuery;


/**
 * This class defines the structure of the 'detalle' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class DetalleTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.DetalleTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'detalle';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\Detalle';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.Detalle';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the idDetalle field
     */
    const COL_IDDETALLE = 'detalle.idDetalle';

    /**
     * the column name for the idBoleta field
     */
    const COL_IDBOLETA = 'detalle.idBoleta';

    /**
     * the column name for the idProducto field
     */
    const COL_IDPRODUCTO = 'detalle.idProducto';

    /**
     * the column name for the cantidad field
     */
    const COL_CANTIDAD = 'detalle.cantidad';

    /**
     * the column name for the precio field
     */
    const COL_PRECIO = 'detalle.precio';

    /**
     * the column name for the subTotal field
     */
    const COL_SUBTOTAL = 'detalle.subTotal';

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
        self::TYPE_PHPNAME       => array('Iddetalle', 'Idboleta', 'Idproducto', 'Cantidad', 'Precio', 'Subtotal', ),
        self::TYPE_CAMELNAME     => array('iddetalle', 'idboleta', 'idproducto', 'cantidad', 'precio', 'subtotal', ),
        self::TYPE_COLNAME       => array(DetalleTableMap::COL_IDDETALLE, DetalleTableMap::COL_IDBOLETA, DetalleTableMap::COL_IDPRODUCTO, DetalleTableMap::COL_CANTIDAD, DetalleTableMap::COL_PRECIO, DetalleTableMap::COL_SUBTOTAL, ),
        self::TYPE_FIELDNAME     => array('idDetalle', 'idBoleta', 'idProducto', 'cantidad', 'precio', 'subTotal', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Iddetalle' => 0, 'Idboleta' => 1, 'Idproducto' => 2, 'Cantidad' => 3, 'Precio' => 4, 'Subtotal' => 5, ),
        self::TYPE_CAMELNAME     => array('iddetalle' => 0, 'idboleta' => 1, 'idproducto' => 2, 'cantidad' => 3, 'precio' => 4, 'subtotal' => 5, ),
        self::TYPE_COLNAME       => array(DetalleTableMap::COL_IDDETALLE => 0, DetalleTableMap::COL_IDBOLETA => 1, DetalleTableMap::COL_IDPRODUCTO => 2, DetalleTableMap::COL_CANTIDAD => 3, DetalleTableMap::COL_PRECIO => 4, DetalleTableMap::COL_SUBTOTAL => 5, ),
        self::TYPE_FIELDNAME     => array('idDetalle' => 0, 'idBoleta' => 1, 'idProducto' => 2, 'cantidad' => 3, 'precio' => 4, 'subTotal' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('detalle');
        $this->setPhpName('Detalle');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\Detalle');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idDetalle', 'Iddetalle', 'INTEGER', true, null, null);
        $this->addForeignKey('idBoleta', 'Idboleta', 'INTEGER', 'boleta', 'idBoleta', true, null, null);
        $this->addForeignKey('idProducto', 'Idproducto', 'INTEGER', 'producto', 'idProducto', true, null, null);
        $this->addColumn('cantidad', 'Cantidad', 'INTEGER', true, null, null);
        $this->addColumn('precio', 'Precio', 'INTEGER', true, null, null);
        $this->addColumn('subTotal', 'Subtotal', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Boleta', '\\models\\models\\Boleta', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idBoleta',
    1 => ':idBoleta',
  ),
), null, null, null, false);
        $this->addRelation('Producto', '\\models\\models\\Producto', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idProducto',
    1 => ':idProducto',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Iddetalle', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? DetalleTableMap::CLASS_DEFAULT : DetalleTableMap::OM_CLASS;
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
     * @return array           (Detalle object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DetalleTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DetalleTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DetalleTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DetalleTableMap::OM_CLASS;
            /** @var Detalle $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DetalleTableMap::addInstanceToPool($obj, $key);
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
            $key = DetalleTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DetalleTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Detalle $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DetalleTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DetalleTableMap::COL_IDDETALLE);
            $criteria->addSelectColumn(DetalleTableMap::COL_IDBOLETA);
            $criteria->addSelectColumn(DetalleTableMap::COL_IDPRODUCTO);
            $criteria->addSelectColumn(DetalleTableMap::COL_CANTIDAD);
            $criteria->addSelectColumn(DetalleTableMap::COL_PRECIO);
            $criteria->addSelectColumn(DetalleTableMap::COL_SUBTOTAL);
        } else {
            $criteria->addSelectColumn($alias . '.idDetalle');
            $criteria->addSelectColumn($alias . '.idBoleta');
            $criteria->addSelectColumn($alias . '.idProducto');
            $criteria->addSelectColumn($alias . '.cantidad');
            $criteria->addSelectColumn($alias . '.precio');
            $criteria->addSelectColumn($alias . '.subTotal');
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
        return Propel::getServiceContainer()->getDatabaseMap(DetalleTableMap::DATABASE_NAME)->getTable(DetalleTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DetalleTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DetalleTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DetalleTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Detalle or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Detalle object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DetalleTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\Detalle) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DetalleTableMap::DATABASE_NAME);
            $criteria->add(DetalleTableMap::COL_IDDETALLE, (array) $values, Criteria::IN);
        }

        $query = DetalleQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DetalleTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DetalleTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the detalle table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DetalleQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Detalle or Criteria object.
     *
     * @param mixed               $criteria Criteria or Detalle object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DetalleTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Detalle object
        }

        if ($criteria->containsKey(DetalleTableMap::COL_IDDETALLE) && $criteria->keyContainsValue(DetalleTableMap::COL_IDDETALLE) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DetalleTableMap::COL_IDDETALLE.')');
        }


        // Set the correct dbName
        $query = DetalleQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DetalleTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DetalleTableMap::buildTableMap();
