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
use models\models\Boleta as ChildBoleta;
use models\models\BoletaQuery as ChildBoletaQuery;
use models\models\Usuario as ChildUsuario;
use models\models\UsuarioQuery as ChildUsuarioQuery;
use models\models\Map\BoletaTableMap;
use models\models\Map\UsuarioTableMap;

/**
 * Base class that represents a row from the 'usuario' table.
 *
 *
 *
 * @package    propel.generator.models.models.Base
 */
abstract class Usuario implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\models\\models\\Map\\UsuarioTableMap';


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
     * The value for the idusuario field.
     *
     * @var        int
     */
    protected $idusuario;

    /**
     * The value for the idsucursal field.
     *
     * @var        int
     */
    protected $idsucursal;

    /**
     * The value for the rut field.
     *
     * @var        int
     */
    protected $rut;

    /**
     * The value for the digito field.
     *
     * @var        string
     */
    protected $digito;

    /**
     * The value for the nombre field.
     *
     * @var        string
     */
    protected $nombre;

    /**
     * The value for the paterno field.
     *
     * @var        string
     */
    protected $paterno;

    /**
     * The value for the materno field.
     *
     * @var        string
     */
    protected $materno;

    /**
     * The value for the clave field.
     *
     * @var        string
     */
    protected $clave;

    /**
     * The value for the activo field.
     *
     * @var        int
     */
    protected $activo;

    /**
     * The value for the esvendedor field.
     *
     * @var        int
     */
    protected $esvendedor;

    /**
     * @var        ObjectCollection|ChildBoleta[] Collection to store aggregation of ChildBoleta objects.
     */
    protected $collBoletas;
    protected $collBoletasPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBoleta[]
     */
    protected $boletasScheduledForDeletion = null;

    /**
     * Initializes internal state of models\models\Base\Usuario object.
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
     * Compares this with another <code>Usuario</code> instance.  If
     * <code>obj</code> is an instance of <code>Usuario</code>, delegates to
     * <code>equals(Usuario)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Usuario The current object, for fluid interface
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
     * Get the [idusuario] column value.
     *
     * @return int
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Get the [idsucursal] column value.
     *
     * @return int
     */
    public function getIdsucursal()
    {
        return $this->idsucursal;
    }

    /**
     * Get the [rut] column value.
     *
     * @return int
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Get the [digito] column value.
     *
     * @return string
     */
    public function getDigito()
    {
        return $this->digito;
    }

    /**
     * Get the [nombre] column value.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the [paterno] column value.
     *
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * Get the [materno] column value.
     *
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * Get the [clave] column value.
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
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
     * Get the [esvendedor] column value.
     *
     * @return int
     */
    public function getEsvendedor()
    {
        return $this->esvendedor;
    }

    /**
     * Set the value of [idusuario] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setIdusuario($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idusuario !== $v) {
            $this->idusuario = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_IDUSUARIO] = true;
        }

        return $this;
    } // setIdusuario()

    /**
     * Set the value of [idsucursal] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setIdsucursal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->idsucursal !== $v) {
            $this->idsucursal = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_IDSUCURSAL] = true;
        }

        return $this;
    } // setIdsucursal()

    /**
     * Set the value of [rut] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setRut($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rut !== $v) {
            $this->rut = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_RUT] = true;
        }

        return $this;
    } // setRut()

    /**
     * Set the value of [digito] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setDigito($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->digito !== $v) {
            $this->digito = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_DIGITO] = true;
        }

        return $this;
    } // setDigito()

    /**
     * Set the value of [nombre] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->nombre !== $v) {
            $this->nombre = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_NOMBRE] = true;
        }

        return $this;
    } // setNombre()

    /**
     * Set the value of [paterno] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setPaterno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->paterno !== $v) {
            $this->paterno = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_PATERNO] = true;
        }

        return $this;
    } // setPaterno()

    /**
     * Set the value of [materno] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setMaterno($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->materno !== $v) {
            $this->materno = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_MATERNO] = true;
        }

        return $this;
    } // setMaterno()

    /**
     * Set the value of [clave] column.
     *
     * @param string $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setClave($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->clave !== $v) {
            $this->clave = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_CLAVE] = true;
        }

        return $this;
    } // setClave()

    /**
     * Set the value of [activo] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setActivo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->activo !== $v) {
            $this->activo = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ACTIVO] = true;
        }

        return $this;
    } // setActivo()

    /**
     * Set the value of [esvendedor] column.
     *
     * @param int $v new value
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function setEsvendedor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->esvendedor !== $v) {
            $this->esvendedor = $v;
            $this->modifiedColumns[UsuarioTableMap::COL_ESVENDEDOR] = true;
        }

        return $this;
    } // setEsvendedor()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsuarioTableMap::translateFieldName('Idusuario', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idusuario = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsuarioTableMap::translateFieldName('Idsucursal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->idsucursal = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsuarioTableMap::translateFieldName('Rut', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rut = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsuarioTableMap::translateFieldName('Digito', TableMap::TYPE_PHPNAME, $indexType)];
            $this->digito = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsuarioTableMap::translateFieldName('Nombre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->nombre = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsuarioTableMap::translateFieldName('Paterno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->paterno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsuarioTableMap::translateFieldName('Materno', TableMap::TYPE_PHPNAME, $indexType)];
            $this->materno = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsuarioTableMap::translateFieldName('Clave', TableMap::TYPE_PHPNAME, $indexType)];
            $this->clave = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsuarioTableMap::translateFieldName('Activo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->activo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsuarioTableMap::translateFieldName('Esvendedor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->esvendedor = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 10; // 10 = UsuarioTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\models\\models\\Usuario'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(UsuarioTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsuarioQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBoletas = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Usuario::setDeleted()
     * @see Usuario::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsuarioQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsuarioTableMap::DATABASE_NAME);
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
                UsuarioTableMap::addInstanceToPool($this);
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

            if ($this->boletasScheduledForDeletion !== null) {
                if (!$this->boletasScheduledForDeletion->isEmpty()) {
                    \models\models\BoletaQuery::create()
                        ->filterByPrimaryKeys($this->boletasScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->boletasScheduledForDeletion = null;
                }
            }

            if ($this->collBoletas !== null) {
                foreach ($this->collBoletas as $referrerFK) {
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

        $this->modifiedColumns[UsuarioTableMap::COL_IDUSUARIO] = true;
        if (null !== $this->idusuario) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioTableMap::COL_IDUSUARIO . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioTableMap::COL_IDUSUARIO)) {
            $modifiedColumns[':p' . $index++]  = 'idUsuario';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IDSUCURSAL)) {
            $modifiedColumns[':p' . $index++]  = 'idSucursal';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_RUT)) {
            $modifiedColumns[':p' . $index++]  = 'rut';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DIGITO)) {
            $modifiedColumns[':p' . $index++]  = 'digito';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = 'nombre';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_PATERNO)) {
            $modifiedColumns[':p' . $index++]  = 'paterno';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_MATERNO)) {
            $modifiedColumns[':p' . $index++]  = 'materno';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_CLAVE)) {
            $modifiedColumns[':p' . $index++]  = 'clave';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ACTIVO)) {
            $modifiedColumns[':p' . $index++]  = 'activo';
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ESVENDEDOR)) {
            $modifiedColumns[':p' . $index++]  = 'esVendedor';
        }

        $sql = sprintf(
            'INSERT INTO usuario (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'idUsuario':
                        $stmt->bindValue($identifier, $this->idusuario, PDO::PARAM_INT);
                        break;
                    case 'idSucursal':
                        $stmt->bindValue($identifier, $this->idsucursal, PDO::PARAM_INT);
                        break;
                    case 'rut':
                        $stmt->bindValue($identifier, $this->rut, PDO::PARAM_INT);
                        break;
                    case 'digito':
                        $stmt->bindValue($identifier, $this->digito, PDO::PARAM_STR);
                        break;
                    case 'nombre':
                        $stmt->bindValue($identifier, $this->nombre, PDO::PARAM_STR);
                        break;
                    case 'paterno':
                        $stmt->bindValue($identifier, $this->paterno, PDO::PARAM_STR);
                        break;
                    case 'materno':
                        $stmt->bindValue($identifier, $this->materno, PDO::PARAM_STR);
                        break;
                    case 'clave':
                        $stmt->bindValue($identifier, $this->clave, PDO::PARAM_STR);
                        break;
                    case 'activo':
                        $stmt->bindValue($identifier, $this->activo, PDO::PARAM_INT);
                        break;
                    case 'esVendedor':
                        $stmt->bindValue($identifier, $this->esvendedor, PDO::PARAM_INT);
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
        $this->setIdusuario($pk);

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
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdusuario();
                break;
            case 1:
                return $this->getIdsucursal();
                break;
            case 2:
                return $this->getRut();
                break;
            case 3:
                return $this->getDigito();
                break;
            case 4:
                return $this->getNombre();
                break;
            case 5:
                return $this->getPaterno();
                break;
            case 6:
                return $this->getMaterno();
                break;
            case 7:
                return $this->getClave();
                break;
            case 8:
                return $this->getActivo();
                break;
            case 9:
                return $this->getEsvendedor();
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

        if (isset($alreadyDumpedObjects['Usuario'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->hashCode()] = true;
        $keys = UsuarioTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdusuario(),
            $keys[1] => $this->getIdsucursal(),
            $keys[2] => $this->getRut(),
            $keys[3] => $this->getDigito(),
            $keys[4] => $this->getNombre(),
            $keys[5] => $this->getPaterno(),
            $keys[6] => $this->getMaterno(),
            $keys[7] => $this->getClave(),
            $keys[8] => $this->getActivo(),
            $keys[9] => $this->getEsvendedor(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBoletas) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'boletas';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'boletas';
                        break;
                    default:
                        $key = 'Boletas';
                }

                $result[$key] = $this->collBoletas->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\models\models\Usuario
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsuarioTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\models\models\Usuario
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdusuario($value);
                break;
            case 1:
                $this->setIdsucursal($value);
                break;
            case 2:
                $this->setRut($value);
                break;
            case 3:
                $this->setDigito($value);
                break;
            case 4:
                $this->setNombre($value);
                break;
            case 5:
                $this->setPaterno($value);
                break;
            case 6:
                $this->setMaterno($value);
                break;
            case 7:
                $this->setClave($value);
                break;
            case 8:
                $this->setActivo($value);
                break;
            case 9:
                $this->setEsvendedor($value);
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
        $keys = UsuarioTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdusuario($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdsucursal($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setRut($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDigito($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setNombre($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPaterno($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setMaterno($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setClave($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setActivo($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setEsvendedor($arr[$keys[9]]);
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
     * @return $this|\models\models\Usuario The current object, for fluid interface
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
        $criteria = new Criteria(UsuarioTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioTableMap::COL_IDUSUARIO)) {
            $criteria->add(UsuarioTableMap::COL_IDUSUARIO, $this->idusuario);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_IDSUCURSAL)) {
            $criteria->add(UsuarioTableMap::COL_IDSUCURSAL, $this->idsucursal);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_RUT)) {
            $criteria->add(UsuarioTableMap::COL_RUT, $this->rut);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_DIGITO)) {
            $criteria->add(UsuarioTableMap::COL_DIGITO, $this->digito);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_NOMBRE)) {
            $criteria->add(UsuarioTableMap::COL_NOMBRE, $this->nombre);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_PATERNO)) {
            $criteria->add(UsuarioTableMap::COL_PATERNO, $this->paterno);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_MATERNO)) {
            $criteria->add(UsuarioTableMap::COL_MATERNO, $this->materno);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_CLAVE)) {
            $criteria->add(UsuarioTableMap::COL_CLAVE, $this->clave);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ACTIVO)) {
            $criteria->add(UsuarioTableMap::COL_ACTIVO, $this->activo);
        }
        if ($this->isColumnModified(UsuarioTableMap::COL_ESVENDEDOR)) {
            $criteria->add(UsuarioTableMap::COL_ESVENDEDOR, $this->esvendedor);
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
        $criteria = ChildUsuarioQuery::create();
        $criteria->add(UsuarioTableMap::COL_IDUSUARIO, $this->idusuario);

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
        $validPk = null !== $this->getIdusuario();

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
        return $this->getIdusuario();
    }

    /**
     * Generic method to set the primary key (idusuario column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdusuario($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdusuario();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \models\models\Usuario (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdsucursal($this->getIdsucursal());
        $copyObj->setRut($this->getRut());
        $copyObj->setDigito($this->getDigito());
        $copyObj->setNombre($this->getNombre());
        $copyObj->setPaterno($this->getPaterno());
        $copyObj->setMaterno($this->getMaterno());
        $copyObj->setClave($this->getClave());
        $copyObj->setActivo($this->getActivo());
        $copyObj->setEsvendedor($this->getEsvendedor());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBoletas() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBoleta($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdusuario(NULL); // this is a auto-increment column, so set to default value
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
     * @return \models\models\Usuario Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Boleta' == $relationName) {
            $this->initBoletas();
            return;
        }
    }

    /**
     * Clears out the collBoletas collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBoletas()
     */
    public function clearBoletas()
    {
        $this->collBoletas = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBoletas collection loaded partially.
     */
    public function resetPartialBoletas($v = true)
    {
        $this->collBoletasPartial = $v;
    }

    /**
     * Initializes the collBoletas collection.
     *
     * By default this just sets the collBoletas collection to an empty array (like clearcollBoletas());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBoletas($overrideExisting = true)
    {
        if (null !== $this->collBoletas && !$overrideExisting) {
            return;
        }

        $collectionClassName = BoletaTableMap::getTableMap()->getCollectionClassName();

        $this->collBoletas = new $collectionClassName;
        $this->collBoletas->setModel('\models\models\Boleta');
    }

    /**
     * Gets an array of ChildBoleta objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBoleta[] List of ChildBoleta objects
     * @throws PropelException
     */
    public function getBoletas(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBoletasPartial && !$this->isNew();
        if (null === $this->collBoletas || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBoletas) {
                // return empty collection
                $this->initBoletas();
            } else {
                $collBoletas = ChildBoletaQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBoletasPartial && count($collBoletas)) {
                        $this->initBoletas(false);

                        foreach ($collBoletas as $obj) {
                            if (false == $this->collBoletas->contains($obj)) {
                                $this->collBoletas->append($obj);
                            }
                        }

                        $this->collBoletasPartial = true;
                    }

                    return $collBoletas;
                }

                if ($partial && $this->collBoletas) {
                    foreach ($this->collBoletas as $obj) {
                        if ($obj->isNew()) {
                            $collBoletas[] = $obj;
                        }
                    }
                }

                $this->collBoletas = $collBoletas;
                $this->collBoletasPartial = false;
            }
        }

        return $this->collBoletas;
    }

    /**
     * Sets a collection of ChildBoleta objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $boletas A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function setBoletas(Collection $boletas, ConnectionInterface $con = null)
    {
        /** @var ChildBoleta[] $boletasToDelete */
        $boletasToDelete = $this->getBoletas(new Criteria(), $con)->diff($boletas);


        $this->boletasScheduledForDeletion = $boletasToDelete;

        foreach ($boletasToDelete as $boletaRemoved) {
            $boletaRemoved->setUsuario(null);
        }

        $this->collBoletas = null;
        foreach ($boletas as $boleta) {
            $this->addBoleta($boleta);
        }

        $this->collBoletas = $boletas;
        $this->collBoletasPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Boleta objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Boleta objects.
     * @throws PropelException
     */
    public function countBoletas(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBoletasPartial && !$this->isNew();
        if (null === $this->collBoletas || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBoletas) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBoletas());
            }

            $query = ChildBoletaQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collBoletas);
    }

    /**
     * Method called to associate a ChildBoleta object to this object
     * through the ChildBoleta foreign key attribute.
     *
     * @param  ChildBoleta $l ChildBoleta
     * @return $this|\models\models\Usuario The current object (for fluent API support)
     */
    public function addBoleta(ChildBoleta $l)
    {
        if ($this->collBoletas === null) {
            $this->initBoletas();
            $this->collBoletasPartial = true;
        }

        if (!$this->collBoletas->contains($l)) {
            $this->doAddBoleta($l);

            if ($this->boletasScheduledForDeletion and $this->boletasScheduledForDeletion->contains($l)) {
                $this->boletasScheduledForDeletion->remove($this->boletasScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBoleta $boleta The ChildBoleta object to add.
     */
    protected function doAddBoleta(ChildBoleta $boleta)
    {
        $this->collBoletas[]= $boleta;
        $boleta->setUsuario($this);
    }

    /**
     * @param  ChildBoleta $boleta The ChildBoleta object to remove.
     * @return $this|ChildUsuario The current object (for fluent API support)
     */
    public function removeBoleta(ChildBoleta $boleta)
    {
        if ($this->getBoletas()->contains($boleta)) {
            $pos = $this->collBoletas->search($boleta);
            $this->collBoletas->remove($pos);
            if (null === $this->boletasScheduledForDeletion) {
                $this->boletasScheduledForDeletion = clone $this->collBoletas;
                $this->boletasScheduledForDeletion->clear();
            }
            $this->boletasScheduledForDeletion[]= clone $boleta;
            $boleta->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Boletas from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBoleta[] List of ChildBoleta objects
     */
    public function getBoletasJoinSucursal(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBoletaQuery::create(null, $criteria);
        $query->joinWith('Sucursal', $joinBehavior);

        return $this->getBoletas($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->idusuario = null;
        $this->idsucursal = null;
        $this->rut = null;
        $this->digito = null;
        $this->nombre = null;
        $this->paterno = null;
        $this->materno = null;
        $this->clave = null;
        $this->activo = null;
        $this->esvendedor = null;
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
            if ($this->collBoletas) {
                foreach ($this->collBoletas as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBoletas = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioTableMap::DEFAULT_STRING_FORMAT);
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
