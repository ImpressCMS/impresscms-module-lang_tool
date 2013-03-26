CREATE TABLE lt_languages (
  lang_id int(5) unsigned NOT NULL auto_increment,
  lang_title varchar(100) NOT NULL,
  dirname varchar(30) NOT NULL,
  PRIMARY KEY  (lang_id)
) TYPE=MyISAM;

INSERT INTO `lt_languages` VALUES ('', 'Inglés', 'english');
INSERT INTO `lt_languages` VALUES ('', 'Francés', 'french');
INSERT INTO `lt_languages` VALUES ('', 'Alemán', 'german');
INSERT INTO `lt_languages` VALUES ('', 'Portugués', 'portuguesebr');
INSERT INTO `lt_languages` VALUES ('', 'Español', 'spanish');