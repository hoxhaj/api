CREATE DATABASE IF NOT EXISTS nested_set_mode;


CREATE TABLE IF NOT EXISTS node_tree (
     idNode INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     level INT UNSIGNED NOT NULL,
     iLeft INT UNSIGNED NOT NULL,
     iRight INT UNSIGNED NOT NULL
);


CREATE TABLE IF NOT EXISTS node_tree_names (
   idNode INT UNSIGNED NOT NULL,
   language ENUM('italian', 'english'),
    nodeName VARCHAR(255) NOT NULL,
    PRIMARY KEY (idNode, language),
    FOREIGN KEY (idNode)
    REFERENCES node_tree(idNode) ON DELETE CASCADE
);