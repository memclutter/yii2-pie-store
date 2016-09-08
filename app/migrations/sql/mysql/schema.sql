CREATE TABLE attr_size
(
    id VARCHAR(128) NOT NULL,
    value VARCHAR(128) NOT NULL
);
CREATE UNIQUE INDEX id ON attr_size (id);
CREATE TABLE migration
(
    version VARCHAR(180) PRIMARY KEY NOT NULL,
    apply_time INT(11)
);
CREATE TABLE products
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    available_count INT(11),
    size_id VARCHAR(128),
    stuffing_id VARCHAR(128),
    target_id VARCHAR(128),
    paste_id VARCHAR(128),
    oven_id VARCHAR(128),
    CONSTRAINT `fk-products-sizes` FOREIGN KEY (size_id) REFERENCES attr_size (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk-products-stuffing` FOREIGN KEY (stuffing_id) REFERENCES attr_stuffing (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk-products-attr_target` FOREIGN KEY (target_id) REFERENCES attr_target (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk-products-attr_paste` FOREIGN KEY (paste_id) REFERENCES attr_paste (id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk-products-attr_oven` FOREIGN KEY (oven_id) REFERENCES attr_oven (id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE INDEX `fk-products-attr_oven` ON products (oven_id);
CREATE INDEX `fk-products-attr_paste` ON products (paste_id);
CREATE INDEX `fk-products-attr_target` ON products (target_id);
CREATE INDEX `fk-products-sizes` ON products (size_id);
CREATE INDEX `fk-products-stuffing` ON products (stuffing_id);
CREATE INDEX `idx-product-price` ON products (price);
CREATE INDEX `idx-product-title` ON products (title);
CREATE TABLE attr_oven
(
    id VARCHAR(128) NOT NULL,
    value VARCHAR(128) NOT NULL
);
CREATE UNIQUE INDEX id ON attr_oven (id);
CREATE TABLE attr_paste
(
    id VARCHAR(128) NOT NULL,
    value VARCHAR(128) NOT NULL
);
CREATE UNIQUE INDEX id ON attr_paste (id);
CREATE TABLE attr_stuffing
(
    id VARCHAR(128) NOT NULL,
    value VARCHAR(128) NOT NULL
);
CREATE UNIQUE INDEX id ON attr_stuffing (id);
CREATE TABLE attr_target
(
    id VARCHAR(128) NOT NULL,
    value VARCHAR(128) NOT NULL
);
CREATE UNIQUE INDEX id ON attr_target (id);