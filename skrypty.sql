CREATE TABLE `pai`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `role` VARCHAR(45) NULL,
  `files_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  UNIQUE INDEX `files_id_UNIQUE` (`files_id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);


create user grzegorz@"%" identified with mysql_native_password by 'password';

grant all privileges on *.* to 'grzegorz'@'%';

flush privileges;

  CREATE TABLE `pai`.`files` (
  `id_user` INT NOT NULL,
  `id_file` INT NOT NULL,
  PRIMARY KEY (`id_user`));


  ALTER TABLE `pai`.`files`
RENAME TO  `pai`.`files_user` ;


CREATE TABLE `pai`.`files` (
  `id_files_user` INT NOT NULL,
  `filename` VARCHAR(45) NULL,
  `original_file_name` VARCHAR(45) NULL,
  `filesize` VARCHAR(45) NULL,
  `file_format` VARCHAR(45) NULL,
  PRIMARY KEY (`id_files_user`));


  ALTER TABLE `pai`.`files_user`
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id_user`, `id_file`);
;

alter table user
drop column files_id;


ALTER TABLE `pai`.`files`
RENAME TO  `pai`.`file` ;

ALTER TABLE `pai`.`file`
CHANGE COLUMN `id_files_user` `id_file` INT(11) NOT NULL ;


CREATE TABLE `pai`.`role` (
  `id_role` INT NOT NULL,
  `name` VARCHAR(45) NULL,
  PRIMARY KEY (`id_role`));

  INSERT INTO `pai`.`role` (`id_role`, `name`) VALUES ('1', 'user');
INSERT INTO `pai`.`role` (`id_role`, `name`) VALUES ('666', 'admin');


ALTER TABLE `pai`.`user`
CHANGE COLUMN `role` `id_role` INT NULL DEFAULT NULL ;

ALTER TABLE `pai`.`file`
CHANGE COLUMN `id_file` `id_file` INT(11) NOT NULL AUTO_INCREMENT ;

ALTER TABLE `pai`.`file`
ADD COLUMN `content` BLOB NULL AFTER `file_format`;


ALTER TABLE `pai`.`file`
ADD COLUMN `file_description` VARCHAR(255) NULL AFTER `content`;


ALTER TABLE `pai`.`user`
CHANGE COLUMN `id_role` `role_name` VARCHAR(45) NULL DEFAULT NULL ;

alter table files_user add foreign key (id_file) references file (id_file);
alter table files_user add foreign key (id_user) references user (id);

ALTER TABLE `pai`.`file`
ADD COLUMN `id_user` INT NULL AFTER `file_description`;
