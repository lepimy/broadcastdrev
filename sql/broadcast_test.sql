delete visitor;
delete question;
delete info;

alter table `visitor`  auto_increment = 1;
alter table `question`  auto_increment = 1;
alter table `info`  auto_increment = 1;

insert into `visitor` (ip, is_active) values ('192.168.1.1', 1);
insert into `visitor` (ip, is_active) values ('192.168.1.2', 1);
insert into `visitor` (ip, is_active) values ('192.168.1.3', 1);
insert into `visitor` (ip, is_active) values ('192.168.1.4', 1);
insert into `visitor` (ip, is_active) values ('192.168.1.5', 1);

insert into `question` (visitor_id, message, is_read, date) values (1, 'I need number 34', 0, '2026-01-11 13:17:17');
insert into `question` (visitor_id, message, is_read, date) values (1, 'I need number 22', 0, '2026-01-11 13:18:34');
insert into `question` (visitor_id, message, is_read, date) values (2, 'I need number 14', 0, '2026-01-11 13:12:12');
insert into `question` (visitor_id, message, is_read, date) values (3, 'I need number 12', 0, '2026-01-11 13:32:43');
insert into `question` (visitor_id, message, is_read, date) values (4, 'I need number 49', 0, '2026-01-11 13:33:21');
insert into `question` (visitor_id, message, is_read, date) values (4, 'I need number 41', 0, '2026-01-11 13:38:41');
insert into `question` (visitor_id, message, is_read, date) values (4, 'I need number 29', 0, '2026-01-11 13:35:11');

insert into info (broadcast_status) VALUES (0);
