
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- boleta
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `boleta`;

CREATE TABLE `boleta`
(
    `idBoleta` INTEGER NOT NULL AUTO_INCREMENT,
    `idUsuario` INTEGER NOT NULL,
    `idSucursal` INTEGER NOT NULL,
    `fecha` DATE NOT NULL,
    `total` INTEGER NOT NULL,
    PRIMARY KEY (`idBoleta`),
    INDEX `idUsuario` (`idUsuario`),
    INDEX `idSucursal` (`idSucursal`),
    CONSTRAINT `boleta_ibfk_1`
        FOREIGN KEY (`idUsuario`)
        REFERENCES `usuario` (`idUsuario`),
    CONSTRAINT `boleta_ibfk_2`
        FOREIGN KEY (`idSucursal`)
        REFERENCES `sucursal` (`idSucursal`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- detalle
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `detalle`;

CREATE TABLE `detalle`
(
    `idDetalle` INTEGER NOT NULL AUTO_INCREMENT,
    `idBoleta` INTEGER NOT NULL,
    `idProducto` INTEGER NOT NULL,
    `cantidad` INTEGER NOT NULL,
    `precio` INTEGER NOT NULL,
    `subTotal` INTEGER NOT NULL,
    PRIMARY KEY (`idDetalle`),
    INDEX `idBoleta` (`idBoleta`),
    INDEX `idProducto` (`idProducto`),
    CONSTRAINT `detalle_ibfk_1`
        FOREIGN KEY (`idBoleta`)
        REFERENCES `boleta` (`idBoleta`),
    CONSTRAINT `detalle_ibfk_2`
        FOREIGN KEY (`idProducto`)
        REFERENCES `producto` (`idProducto`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- marca
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca`
(
    `idMarca` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `activo` TINYINT NOT NULL,
    PRIMARY KEY (`idMarca`),
    UNIQUE INDEX `nombre` (`nombre`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- producto
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto`
(
    `idProducto` INTEGER NOT NULL AUTO_INCREMENT,
    `idMarca` INTEGER NOT NULL,
    `idProveedor` INTEGER NOT NULL,
    `idTipoProducto` INTEGER NOT NULL,
    `nombreProducto` VARCHAR(200) NOT NULL,
    `codigo` INTEGER NOT NULL,
    `descripcion` VARCHAR(2000) NOT NULL,
    `stock` INTEGER NOT NULL,
    `stockMinimo` INTEGER NOT NULL,
    `precio` INTEGER NOT NULL,
    `activo` TINYINT NOT NULL,
    PRIMARY KEY (`idProducto`),
    UNIQUE INDEX `codigo` (`codigo`),
    INDEX `idMarca` (`idMarca`),
    INDEX `idProveedor` (`idProveedor`),
    INDEX `idTipoProducto` (`idTipoProducto`),
    CONSTRAINT `producto_ibfk_1`
        FOREIGN KEY (`idMarca`)
        REFERENCES `marca` (`idMarca`),
    CONSTRAINT `producto_ibfk_2`
        FOREIGN KEY (`idProveedor`)
        REFERENCES `proveedor` (`idProveedor`),
    CONSTRAINT `producto_ibfk_3`
        FOREIGN KEY (`idTipoProducto`)
        REFERENCES `tipoproducto` (`idTipoProducto`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- proveedor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor`
(
    `idProveedor` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `activo` TINYINT NOT NULL,
    PRIMARY KEY (`idProveedor`),
    UNIQUE INDEX `nombre` (`nombre`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sucursal
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sucursal`;

CREATE TABLE `sucursal`
(
    `idSucursal` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `activo` TINYINT NOT NULL,
    PRIMARY KEY (`idSucursal`),
    UNIQUE INDEX `nombre` (`nombre`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- tipoproducto
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tipoproducto`;

CREATE TABLE `tipoproducto`
(
    `idTipoProducto` INTEGER NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(100) NOT NULL,
    `activo` TINYINT NOT NULL,
    PRIMARY KEY (`idTipoProducto`),
    UNIQUE INDEX `nombre` (`nombre`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- usuario
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario`
(
    `idUsuario` INTEGER NOT NULL AUTO_INCREMENT,
    `idSucursal` INTEGER NOT NULL,
    `rut` INTEGER NOT NULL,
    `digito` VARCHAR(1) NOT NULL,
    `nombre` VARCHAR(50) NOT NULL,
    `paterno` VARCHAR(50) NOT NULL,
    `materno` VARCHAR(50) NOT NULL,
    `clave` VARCHAR(50) NOT NULL,
    `activo` TINYINT NOT NULL,
    `esVendedor` TINYINT NOT NULL,
    PRIMARY KEY (`idUsuario`),
    UNIQUE INDEX `rut` (`rut`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
