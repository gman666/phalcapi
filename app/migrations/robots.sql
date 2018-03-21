
create table robots (
    id int not null auto_increment primary key,
    name varchar(200) not null,
    type enum('droid', 'mechanical', 'virtual') not null default 'droid',
    year int(4) not null
);