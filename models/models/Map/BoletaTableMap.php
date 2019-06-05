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
use models\models\Boleta;
use models\models\BoletaQuery;


/**
 * This class defines the structure of the 'boleta' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class BoletaTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'models.models.Map.BoletaTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'boleta';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\models\\models\\Boleta';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'models.models.Boleta';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the idBoleta field
     */
    const COL_IDBOLETA = 'boleta.idBoleta';

    /**
     * the column name for the idUsuario field
     */
    const COL_IDUSUARIO = 'boleta.idUsuario';

    /**
     * the column name for the idSucursal field
     */
    const COL_IDSUCURSAL = 'boleta.idSucursal';

    /**
     * the column name for the fecha field
     */
    const COL_FECHA = 'boleta.fecha';

    /**
     * the column name for the total field
     */
    const COL_TOTAL = 'boleta.total';

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
        self::TYPE_PHPNAME       => array('Idboleta', 'Idusuario', 'Idsucursal', 'Fecha', 'Total', ),
        self::TYPE_CAMELNAME     => array('idboleta', 'idusuario', 'idsucursal', 'fecha', 'total', ),
        self::TYPE_COLNAME       => array(BoletaTableMap::COL_IDBOLETA, BoletaTableMap::COL_IDUSUARIO, BoletaTableMap::COL_IDSUCURSAL, BoletaTableMap::COL_FECHA, BoletaTableMap::COL_TOTAL, ),
        self::TYPE_FIELDNAME     => array('idBoleta', 'idUsuario', 'idSucursal', 'fecha', 'total', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Idboleta' => 0, 'Idusuario' => 1, 'Idsucursal' => 2, 'Fecha' => 3, 'Total' => 4, ),
        self::TYPE_CAMELNAME     => array('idboleta' => 0, 'idusuario' => 1, 'idsucursal' => 2, 'fecha' => 3, 'total' => 4, ),
        self::TYPE_COLNAME       => array(BoletaTableMap::COL_IDBOLETA => 0, BoletaTableMap::COL_IDUSUARIO => 1, BoletaTableMap::COL_IDSUCURSAL => 2, BoletaTableMap::COL_FECHA => 3, BoletaTableMap::COL_TOTAL => 4, ),
        self::TYPE_FIELDNAME     => array('idBoleta' => 0, 'idUsuario' => 1, 'idSucursal' => 2, 'fecha' => 3, 'total' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('boleta');
        $this->setPhpName('Boleta');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\models\\models\\Boleta');
        $this->setPackage('models.models');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('idBoleta', 'Idboleta', 'INTEGER', true, null, null);
        $this->addForeignKey('idUsuario', 'Idusuario', 'INTEGER', 'usuario', 'idUsuario', true, null, null);
        $this->addForeignKey('idSucursal', 'Idsucursal', 'INTEGER', 'sucursal', 'idSucursal', true, null, null);
        $this->addColumn('fecha', 'Fecha', 'DATE', true, null, null);
        $this->addColumn('total', 'Total', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Usuario', '\\models\\models\\Usuario', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idUsuario',
    1 => ':idUsuario',
  ),
), null, null, null, false);
        $this->addRelation('Sucursal', '\\models\\models\\Sucursal', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':idSucursal',
    1 => ':idSucursal',
  ),
), null, null, null, false);
        $this->addRelation('Detalle', '\\models\\models\\Detalle', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':idBoleta',
    1 => ':idBoleta',
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Idboleta', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? BoletaTableMap::CLASS_DEFAULT : BoletaTableMap::OM_CLASS;
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
     * @return array           (Boleta object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BoletaTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BoletaTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BoletaTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BoletaTableMap::OM_CLASS;
            /** @var Boleta $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BoletaTableMap::addInstanceToPool($obj, $key);
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
            $key = BoletaTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BoletaTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Boleta $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BoletaTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BoletaTableMap::COL_IDBOLETA);
            $criteria->addSelectColumn(BoletaTableMap::COL_IDUSUARIO);
            $criteria->addSelectColumn(BoletaTableMap::COL_IDSUCURSAL);
            $criteria->addSelectColumn(BoletaTableMap::COL_FECHA);
            $criteria->addSelectColumn(BoletaTableMap::COL_TOTAL);
        } else {
            $criteria->addSelectColumn($alias . '.idBoleta');
            $criteria->addSelectColumn($alias . '.idUsuario');
            $criteria->addSelectColumn($alias . '.idSucursal');
            $criteria->addSelectColumn($alias . '.fecha');
            $criteria->addSelectColumn($alias . '.total');
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
        return Propel::getServiceContainer()->getDatabaseMap(BoletaTableMap::DATABASE_NAME)->getTable(BoletaTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(BoletaTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(BoletaTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new BoletaTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Boleta or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Boleta object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BoletaTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \models\models\Boleta) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BoletaTableMap::DATABASE_NAME);
            $criteria->add(BoletaTableMap::COL_IDBOLETA, (array) $values, Criteria::IN);
        }

        $query = BoletaQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BoletaTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BoletaTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the boleta table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BoletaQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Boleta or Criteria object.
     *
     * @param mixed               $criteria Criteria or Boleta object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BoletaTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Boleta object
        }

        if ($criteria->containsKey(BoletaTableMap::COL_IDBOLETA) && $criteria->keyContainsValue(BoletaTableMap::COL_IDBOLETA) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BoletaTableMap::COL_IDBOLETA.')');
        }


        // Set the correct dbName
        $query = BoletaQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BoletaTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BoletaTableMap::buildTableMap();
