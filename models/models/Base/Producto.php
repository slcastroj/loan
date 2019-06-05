<?php

namespace models\models\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use models\models\Detalle as ChildDetalle;
use models\models\DetalleQuery as ChildDetalleQuery;
use models\models\Marca as ChildMarca;
use models\models\MarcaQuery as ChildMarcaQuery;
use models\models\Producto as ChildProducto;
use models\models\ProductoQuery as ChildProductoQuery;
use models\models\Proveedor as ChildProveedor;
use models\models\ProveedorQuery as ChildProveedorQuery;
use models\models\Tipoproducto as ChildTipoproducto;
use models\models\TipoproductoQuery as ChildTipoproductoQuery;
use models\models\Map\DetalleTableMap;
use models\models\Map\ProductoTableMap;

/**
 * Base class that represents a row from the 'producto' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class Producto implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\ProductoTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the idproducto field.
     *
     * @var        int
     */
    protected $idproducto;

    /**
     * The value for the idmarca field.
     *
     * @var        int
     */
    protected $idmarca;

    /**
     * The value for the idproveedor field.
     *
     * @var        int
     */
    protected $idproveedor;

    /**
     * The value for the idtipoproducto field.
     *
     * @var        int
     */
    protected $idtipoproducto;

    /**
     * The value for the nombreproducto field.
     *
     * @var        string
     */
    protected $nombreproducto;

    /**
     * The value for the codigo field.
     *
     * @var        int
     */
    protected $codigo;

    /**
     * The value for the descripcion field.
     *
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the stock field.
     *
     * @var        int
     */
    protected $stock;

    /**
     * The value for the stockminimo field.
     *
     * @var        int
     */
    protected $stockminimo;

    /**
     * The value for the precio field.
     *
     * @var        int
     */
    protected $precio;

    /**
     * The value for the activo field.
     *
     * @var        int
     */
    protected $activo;

    /**
     * @var        ChildMarca
     */
    protected $aMarca;

    /**
     * @var        ChildProveedor
     */
    protected $aProveedor;

    /**
     * @var        ChildTipoproducto
     */
    protected $aTipoproducto;

    /**
     * @var        ObjectCollection|ChildDetalle[] Collection to store aggregation of ChildDetalle objects.
     */
    protected $collDetalles;
    protected $collDetallesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDetalle[]
     */
    protected $detallesScheduledForDeletion = null;

    /**
     * Initializes internal state of models\models\Base\Producto object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Producto</code> instance.  If
     * <code>obj</code> is an instance of <code>Producto</code>, delegates to
     * <code>equals(Producto)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Producto The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [idproducto] column value.
     *
     * @return int
     */
    public function getIdproducto()
    {
        return $this->idproducto;
    }

    /**
     * Get the [idmarca] column value.
     *
     * @return int
     */
    public function getIdmarca()
    {
        return $this->idmarca;
    }

    /**
     * Get the [idproveedor] column value.
     *
     * @return int
     */
    public function getIdproveedor()
    {
        return $this->idproveedor;
    }

    /**
     * Get the [idtipoproducto] column value.
     *
     * @return int
     */
    public function getIdtipoproducto()
    {
        return $this->idtipoproducto;
    }

    /**
     * Get the [nombreproducto] column value.
     *
     * @return string
     */
    public function getNombreproducto()
    {
        return $this->nombreproducto;
    }

    /**
     * Get the [codigo] column value.
     *
     * @return int
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the [stock] column value.
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Get the [stockminimo] column value.
     *
     * @return int
     */
    public function getStockminimo()
    {
        return $this->stockminimo;
    }

    /**
     * Get the [precio] column value.
     *
     * @return int
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the [activo] column value.
     *
     * @return int
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set the value of [idproducto] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setIdproducto($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idproducto !== $v) {
            $this->idproducto = $v;
            $this->modifiedColumns[ProductoTableMap::COL_IDPRODUCTO] = true;
        }

        return $this;
    } // setIdproducto()

    /**
     * Set the value of [idmarca] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setIdmarca($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idmarca !== $v) {
            $this->idmarca = $v;
            $this->modifiedColumns[ProductoTableMap::COL_IDMARCA] = true;
        }

        if ($this->aMarca !== null && $this->aMarca->getIdmarca() !== $v) {
            $this->aMarca = null;
        }

        return $this;
    } // setIdmarca()

    /**
     * Set the value of [idproveedor] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setIdproveedor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idproveedor !== $v) {
            $this->idproveedor = $v;
            $this->modifiedColumns[ProductoTableMap::COL_IDPROVEEDOR] = true;
        }

        if ($this->aProveedor !== null && $this->aProveedor->getIdproveedor() !== $v) {
            $this->aProveedor = null;
        }

        return $this;
    } // setIdproveedor()

    /**
     * Set the value of [idtipoproducto] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setIdtipoproducto($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idtipoproducto !== $v) {
            $this->idtipoproducto = $v;
            $this->modifiedColumns[ProductoTableMap::COL_IDTIPOPRODUCTO] = true;
        }

        if ($this->aTipoproducto !== null && $this->aTipoproducto->getIdtipoproducto() !== $v) {
            $this->aTipoproducto = null;
        }

        return $this;
    } // setIdtipoproducto()

    /**
     * Set the value of [nombreproducto] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setNombreproducto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombreproducto !== $v) {
            $this->nombreproducto = $v;
            $this->modifiedColumns[ProductoTableMap::COL_NOMBREPRODUCTO] = true;
        }

        return $this;
    } // setNombreproducto()

    /**
     * Set the value of [codigo] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setCodigo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codigo !== $v) {
            $this->codigo = $v;
            $this->modifiedColumns[ProductoTableMap::COL_CODIGO] = true;
        }

        return $this;
    } // setCodigo()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[ProductoTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [stock] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setStock($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stock !== $v) {
            $this->stock = $v;
            $this->modifiedColumns[ProductoTableMap::COL_STOCK] = true;
        }

        return $this;
    } // setStock()

    /**
     * Set the value of [stockminimo] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setStockminimo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->stockminimo !== $v) {
            $this->stockminimo = $v;
            $this->modifiedColumns[ProductoTableMap::COL_STOCKMINIMO] = true;
        }

        return $this;
    } // setStockminimo()

    /**
     * Set the value of [precio] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setPrecio($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->precio !== $v) {
            $this->precio = $v;
            $this->modifiedColumns[ProductoTableMap::COL_PRECIO] = true;
        }

        return $this;
    } // setPrecio()

    /**
     * Set the value of [activo] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function setActivo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->activo !== $v) {
            $this->activo = $v;
            $this->modifiedColumns[ProductoTableMap::COL_ACTIVO] = true;
        }

        return $this;
    } // setActivo()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ProductoTableMap::translateFieldName('Idproducto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idproducto = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ProductoTableMap::translateFieldName('Idmarca', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idmarca = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ProductoTableMap::translateFieldName('Idproveedor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idproveedor = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ProductoTableMap::translateFieldName('Idtipoproducto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idtipoproducto = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ProductoTableMap::translateFieldName('Nombreproducto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombreproducto = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ProductoTableMap::translateFieldName('Codigo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codigo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ProductoTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ProductoTableMap::translateFieldName('Stock', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stock = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ProductoTableMap::translateFieldName('Stockminimo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->stockminimo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ProductoTableMap::translateFieldName('Precio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->precio = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ProductoTableMap::translateFieldName('Activo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activo = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = ProductoTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\Producto'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aMarca !== null && $this->idmarca !== $this->aMarca->getIdmarca()) {
            $this->aMarca = null;
        }
        if ($this->aProveedor !== null && $this->idproveedor !== $this->aProveedor->getIdproveedor()) {
            $this->aProveedor = null;
        }
        if ($this->aTipoproducto !== null && $this->idtipoproducto !== $this->aTipoproducto->getIdtipoproducto()) {
            $this->aTipoproducto = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProductoTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildProductoQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aMarca = null;
            $this->aProveedor = null;
            $this->aTipoproducto = null;
            $this->collDetalles = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Producto::setDeleted()
     * @see Producto::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildProductoQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProductoTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ProductoTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aMarca !== null) {
                if ($this->aMarca->isModified() || $this->aMarca->isNew()) {
                    $affectedRows += $this->aMarca->save($con);
                }
                $this->setMarca($this->aMarca);
            }

            if ($this->aProveedor !== null) {
                if ($this->aProveedor->isModified() || $this->aProveedor->isNew()) {
                    $affectedRows += $this->aProveedor->save($con);
                }
                $this->setProveedor($this->aProveedor);
            }

            if ($this->aTipoproducto !== null) {
                if ($this->aTipoproducto->isModified() || $this->aTipoproducto->isNew()) {
                    $affectedRows += $this->aTipoproducto->save($con);
                }
                $this->setTipoproducto($this->aTipoproducto);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->detallesScheduledForDeletion !== null) {
                if (!$this->detallesScheduledForDeletion->isEmpty()) {
                    \models\models\DetalleQuery::create()
                        ->filterByPrimaryKeys($this->detallesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->detallesScheduledForDeletion = null;
                }
            }

            if ($this->collDetalles !== null) {
                foreach ($this->collDetalles as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ProductoTableMap::COL_IDPRODUCTO] = true;
        if (null !== $this->idproducto) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProductoTableMap::COL_IDPRODUCTO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProductoTableMap::COL_IDPRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = 'idProducto';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDMARCA)) {
            $modifiedColumns[':p' . $index++]  = 'idMarca';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDPROVEEDOR)) {
            $modifiedColumns[':p' . $index++]  = 'idProveedor';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDTIPOPRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = 'idTipoProducto';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_NOMBREPRODUCTO)) {
            $modifiedColumns[':p' . $index++]  = 'nombreProducto';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_CODIGO)) {
            $modifiedColumns[':p' . $index++]  = 'codigo';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'descripcion';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_STOCK)) {
            $modifiedColumns[':p' . $index++]  = 'stock';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_STOCKMINIMO)) {
            $modifiedColumns[':p' . $index++]  = 'stockMinimo';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_PRECIO)) {
            $modifiedColumns[':p' . $index++]  = 'precio';
        }
        if ($this->isColumnModified(ProductoTableMap::COL_ACTIVO)) {
            $modifiedColumns[':p' . $index++]  = 'activo';
        }

        $sql = sprintf(
            'INSERT INTO producto (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idProducto':
                        $stmt->bindValue($identifier, $this->idproducto, PDO::PARAM_INT);
                        break;
                    case 'idMarca':
                        $stmt->bindValue($identifier, $this->idmarca, PDO::PARAM_INT);
                        break;
                    case 'idProveedor':
                        $stmt->bindValue($identifier, $this->idproveedor, PDO::PARAM_INT);
                        break;
                    case 'idTipoProducto':
                        $stmt->bindValue($identifier, $this->idtipoproducto, PDO::PARAM_INT);
                        break;
                    case 'nombreProducto':
                        $stmt->bindValue($identifier, $this->nombreproducto, PDO::PARAM_STR);
                        break;
                    case 'codigo':
                        $stmt->bindValue($identifier, $this->codigo, PDO::PARAM_INT);
                        break;
                    case 'descripcion':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case 'stock':
                        $stmt->bindValue($identifier, $this->stock, PDO::PARAM_INT);
                        break;
                    case 'stockMinimo':
                        $stmt->bindValue($identifier, $this->stockminimo, PDO::PARAM_INT);
                        break;
                    case 'precio':
                        $stmt->bindValue($identifier, $this->precio, PDO::PARAM_INT);
                        break;
                    case 'activo':
                        $stmt->bindValue($identifier, $this->activo, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setIdproducto($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdproducto();
                break;
            case 1:
                return $this->getIdmarca();
                break;
            case 2:
                return $this->getIdproveedor();
                break;
            case 3:
                return $this->getIdtipoproducto();
                break;
            case 4:
                return $this->getNombreproducto();
                break;
            case 5:
                return $this->getCodigo();
                break;
            case 6:
                return $this->getDescripcion();
                break;
            case 7:
                return $this->getStock();
                break;
            case 8:
                return $this->getStockminimo();
                break;
            case 9:
                return $this->getPrecio();
                break;
            case 10:
                return $this->getActivo();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Producto'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Producto'][$this->hashCode()] = true;
        $keys = ProductoTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdproducto(),
            $keys[1] => $this->getIdmarca(),
            $keys[2] => $this->getIdproveedor(),
            $keys[3] => $this->getIdtipoproducto(),
            $keys[4] => $this->getNombreproducto(),
            $keys[5] => $this->getCodigo(),
            $keys[6] => $this->getDescripcion(),
            $keys[7] => $this->getStock(),
            $keys[8] => $this->getStockminimo(),
            $keys[9] => $this->getPrecio(),
            $keys[10] => $this->getActivo(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aMarca) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'marca';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'marca';
                        break;
                    default:
                        $key = 'Marca';
                }

                $result[$key] = $this->aMarca->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aProveedor) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'proveedor';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'proveedor';
                        break;
                    default:
                        $key = 'Proveedor';
                }

                $result[$key] = $this->aProveedor->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aTipoproducto) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'tipoproducto';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'tipoproducto';
                        break;
                    default:
                        $key = 'Tipoproducto';
                }

                $result[$key] = $this->aTipoproducto->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDetalles) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'detalles';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'detalles';
                        break;
                    default:
                        $key = 'Detalles';
                }

                $result[$key] = $this->collDetalles->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\models\models\Producto
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ProductoTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\Producto
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdproducto($value);
                break;
            case 1:
                $this->setIdmarca($value);
                break;
            case 2:
                $this->setIdproveedor($value);
                break;
            case 3:
                $this->setIdtipoproducto($value);
                break;
            case 4:
                $this->setNombreproducto($value);
                break;
            case 5:
                $this->setCodigo($value);
                break;
            case 6:
                $this->setDescripcion($value);
                break;
            case 7:
                $this->setStock($value);
                break;
            case 8:
                $this->setStockminimo($value);
                break;
            case 9:
                $this->setPrecio($value);
                break;
            case 10:
                $this->setActivo($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ProductoTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdproducto($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdmarca($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdproveedor($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setIdtipoproducto($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombreproducto($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCodigo($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setDescripcion($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStock($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setStockminimo($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPrecio($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setActivo($arr[$keys[10]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\models\models\Producto The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProductoTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ProductoTableMap::COL_IDPRODUCTO)) {
            $criteria->add(ProductoTableMap::COL_IDPRODUCTO, $this->idproducto);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDMARCA)) {
            $criteria->add(ProductoTableMap::COL_IDMARCA, $this->idmarca);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDPROVEEDOR)) {
            $criteria->add(ProductoTableMap::COL_IDPROVEEDOR, $this->idproveedor);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_IDTIPOPRODUCTO)) {
            $criteria->add(ProductoTableMap::COL_IDTIPOPRODUCTO, $this->idtipoproducto);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_NOMBREPRODUCTO)) {
            $criteria->add(ProductoTableMap::COL_NOMBREPRODUCTO, $this->nombreproducto);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_CODIGO)) {
            $criteria->add(ProductoTableMap::COL_CODIGO, $this->codigo);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_DESCRIPCION)) {
            $criteria->add(ProductoTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_STOCK)) {
            $criteria->add(ProductoTableMap::COL_STOCK, $this->stock);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_STOCKMINIMO)) {
            $criteria->add(ProductoTableMap::COL_STOCKMINIMO, $this->stockminimo);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_PRECIO)) {
            $criteria->add(ProductoTableMap::COL_PRECIO, $this->precio);
        }
        if ($this->isColumnModified(ProductoTableMap::COL_ACTIVO)) {
            $criteria->add(ProductoTableMap::COL_ACTIVO, $this->activo);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildProductoQuery::create();
        $criteria->add(ProductoTableMap::COL_IDPRODUCTO, $this->idproducto);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdproducto();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdproducto();
    }

    /**
     * Generic method to set the primary key (idproducto column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdproducto($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdproducto();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\Producto (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdmarca($this->getIdmarca());
        $copyObj->setIdproveedor($this->getIdproveedor());
        $copyObj->setIdtipoproducto($this->getIdtipoproducto());
        $copyObj->setNombreproducto($this->getNombreproducto());
        $copyObj->setCodigo($this->getCodigo());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setStock($this->getStock());
        $copyObj->setStockminimo($this->getStockminimo());
        $copyObj->setPrecio($this->getPrecio());
        $copyObj->setActivo($this->getActivo());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDetalles() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDetalle($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdproducto(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \models\models\Producto Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildMarca object.
     *
     * @param  ChildMarca $v
     * @return $this|\models\models\Producto The current object (for fluent API support)
     * @throws PropelException
     */
    public function setMarca(ChildMarca $v = null)
    {
        if ($v === null) {
            $this->setIdmarca(NULL);
        } else {
            $this->setIdmarca($v->getIdmarca());
        }

        $this->aMarca = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildMarca object, it will not be re-added.
        if ($v !== null) {
            $v->addProducto($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildMarca object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildMarca The associated ChildMarca object.
     * @throws PropelException
     */
    public function getMarca(ConnectionInterface $con = null)
    {
        if ($this->aMarca === null && ($this->idmarca != 0)) {
            $this->aMarca = ChildMarcaQuery::create()->findPk($this->idmarca, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aMarca->addProductos($this);
             */
        }

        return $this->aMarca;
    }

    /**
     * Declares an association between this object and a ChildProveedor object.
     *
     * @param  ChildProveedor $v
     * @return $this|\models\models\Producto The current object (for fluent API support)
     * @throws PropelException
     */
    public function setProveedor(ChildProveedor $v = null)
    {
        if ($v === null) {
            $this->setIdproveedor(NULL);
        } else {
            $this->setIdproveedor($v->getIdproveedor());
        }

        $this->aProveedor = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildProveedor object, it will not be re-added.
        if ($v !== null) {
            $v->addProducto($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildProveedor object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildProveedor The associated ChildProveedor object.
     * @throws PropelException
     */
    public function getProveedor(ConnectionInterface $con = null)
    {
        if ($this->aProveedor === null && ($this->idproveedor != 0)) {
            $this->aProveedor = ChildProveedorQuery::create()->findPk($this->idproveedor, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aProveedor->addProductos($this);
             */
        }

        return $this->aProveedor;
    }

    /**
     * Declares an association between this object and a ChildTipoproducto object.
     *
     * @param  ChildTipoproducto $v
     * @return $this|\models\models\Producto The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTipoproducto(ChildTipoproducto $v = null)
    {
        if ($v === null) {
            $this->setIdtipoproducto(NULL);
        } else {
            $this->setIdtipoproducto($v->getIdtipoproducto());
        }

        $this->aTipoproducto = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildTipoproducto object, it will not be re-added.
        if ($v !== null) {
            $v->addProducto($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildTipoproducto object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildTipoproducto The associated ChildTipoproducto object.
     * @throws PropelException
     */
    public function getTipoproducto(ConnectionInterface $con = null)
    {
        if ($this->aTipoproducto === null && ($this->idtipoproducto != 0)) {
            $this->aTipoproducto = ChildTipoproductoQuery::create()->findPk($this->idtipoproducto, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTipoproducto->addProductos($this);
             */
        }

        return $this->aTipoproducto;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Detalle' == $relationName) {
            $this->initDetalles();
            return;
        }
    }

    /**
     * Clears out the collDetalles collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDetalles()
     */
    public function clearDetalles()
    {
        $this->collDetalles = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDetalles collection loaded partially.
     */
    public function resetPartialDetalles($v = true)
    {
        $this->collDetallesPartial = $v;
    }

    /**
     * Initializes the collDetalles collection.
     *
     * By default this just sets the collDetalles collection to an empty array (like clearcollDetalles());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDetalles($overrideExisting = true)
    {
        if (null !== $this->collDetalles && !$overrideExisting) {
            return;
        }

        $collectionClassName = DetalleTableMap::getTableMap()->getCollectionClassName();

        $this->collDetalles = new $collectionClassName;
        $this->collDetalles->setModel('\models\models\Detalle');
    }

    /**
     * Gets an array of ChildDetalle objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProducto is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDetalle[] List of ChildDetalle objects
     * @throws PropelException
     */
    public function getDetalles(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallesPartial && !$this->isNew();
        if (null === $this->collDetalles || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collDetalles) {
                // return empty collection
                $this->initDetalles();
            } else {
                $collDetalles = ChildDetalleQuery::create(null, $criteria)
                    ->filterByProducto($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDetallesPartial && count($collDetalles)) {
                        $this->initDetalles(false);

                        foreach ($collDetalles as $obj) {
                            if (false == $this->collDetalles->contains($obj)) {
                                $this->collDetalles->append($obj);
                            }
                        }

                        $this->collDetallesPartial = true;
                    }

                    return $collDetalles;
                }

                if ($partial && $this->collDetalles) {
                    foreach ($this->collDetalles as $obj) {
                        if ($obj->isNew()) {
                            $collDetalles[] = $obj;
                        }
                    }
                }

                $this->collDetalles = $collDetalles;
                $this->collDetallesPartial = false;
            }
        }

        return $this->collDetalles;
    }

    /**
     * Sets a collection of ChildDetalle objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $detalles A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProducto The current object (for fluent API support)
     */
    public function setDetalles(Collection $detalles, ConnectionInterface $con = null)
    {
        /** @var ChildDetalle[] $detallesToDelete */
        $detallesToDelete = $this->getDetalles(new Criteria(), $con)->diff($detalles);


        $this->detallesScheduledForDeletion = $detallesToDelete;

        foreach ($detallesToDelete as $detalleRemoved) {
            $detalleRemoved->setProducto(null);
        }

        $this->collDetalles = null;
        foreach ($detalles as $detalle) {
            $this->addDetalle($detalle);
        }

        $this->collDetalles = $detalles;
        $this->collDetallesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Detalle objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Detalle objects.
     * @throws PropelException
     */
    public function countDetalles(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDetallesPartial && !$this->isNew();
        if (null === $this->collDetalles || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDetalles) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDetalles());
            }

            $query = ChildDetalleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProducto($this)
                ->count($con);
        }

        return count($this->collDetalles);
    }

    /**
     * Method called to associate a ChildDetalle object to this object
     * through the ChildDetalle foreign key attribute.
     *
     * @param  ChildDetalle $l ChildDetalle
     * @return $this|\models\models\Producto The current object (for fluent API support)
     */
    public function addDetalle(ChildDetalle $l)
    {
        if ($this->collDetalles === null) {
            $this->initDetalles();
            $this->collDetallesPartial = true;
        }

        if (!$this->collDetalles->contains($l)) {
            $this->doAddDetalle($l);

            if ($this->detallesScheduledForDeletion and $this->detallesScheduledForDeletion->contains($l)) {
                $this->detallesScheduledForDeletion->remove($this->detallesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDetalle $detalle The ChildDetalle object to add.
     */
    protected function doAddDetalle(ChildDetalle $detalle)
    {
        $this->collDetalles[]= $detalle;
        $detalle->setProducto($this);
    }

    /**
     * @param  ChildDetalle $detalle The ChildDetalle object to remove.
     * @return $this|ChildProducto The current object (for fluent API support)
     */
    public function removeDetalle(ChildDetalle $detalle)
    {
        if ($this->getDetalles()->contains($detalle)) {
            $pos = $this->collDetalles->search($detalle);
            $this->collDetalles->remove($pos);
            if (null === $this->detallesScheduledForDeletion) {
                $this->detallesScheduledForDeletion = clone $this->collDetalles;
                $this->detallesScheduledForDeletion->clear();
            }
            $this->detallesScheduledForDeletion[]= clone $detalle;
            $detalle->setProducto(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Producto is new, it will return
     * an empty collection; or if this Producto has previously
     * been saved, it will retrieve related Detalles from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Producto.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDetalle[] List of ChildDetalle objects
     */
    public function getDetallesJoinBoleta(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDetalleQuery::create(null, $criteria);
        $query->joinWith('Boleta', $joinBehavior);

        return $this->getDetalles($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aMarca) {
            $this->aMarca->removeProducto($this);
        }
        if (null !== $this->aProveedor) {
            $this->aProveedor->removeProducto($this);
        }
        if (null !== $this->aTipoproducto) {
            $this->aTipoproducto->removeProducto($this);
        }
        $this->idproducto = null;
        $this->idmarca = null;
        $this->idproveedor = null;
        $this->idtipoproducto = null;
        $this->nombreproducto = null;
        $this->codigo = null;
        $this->descripcion = null;
        $this->stock = null;
        $this->stockminimo = null;
        $this->precio = null;
        $this->activo = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collDetalles) {
                foreach ($this->collDetalles as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDetalles = null;
        $this->aMarca = null;
        $this->aProveedor = null;
        $this->aTipoproducto = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProductoTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
