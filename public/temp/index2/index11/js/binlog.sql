/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=1*/;
/*!40019 SET @@session.max_insert_delayed_threads=0*/;
/*!50003 SET @OLD_COMPLETION_TYPE=@@COMPLETION_TYPE,COMPLETION_TYPE=0*/;
DELIMITER /*!*/;
# at 4
#171025 16:31:25 server id 1  end_log_pos 107 	Start: binlog v 4, server v 5.5.40-log created 171025 16:31:25
# Warning: this binlog is either in use or was not closed properly.
BINLOG '
3UvwWQ8BAAAAZwAAAGsAAAABAAQANS41LjQwLWxvZwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAAAAAAAAAAAAAAAAAEzgNAAgAEgAEBAQEEgAAVAAEGggAAAAICAgCAA==
'/*!*/;
# at 951737003
#171128  7:26:14 server id 1  end_log_pos 951737076 	Query	thread_id=532858854	exec_time=0	error_code=0
SET TIMESTAMP=1511825174/*!*/;
SET @@session.pseudo_thread_id=532858854/*!*/;
SET @@session.foreign_key_checks=1, @@session.sql_auto_is_null=0, @@session.unique_checks=1, @@session.autocommit=1/*!*/;
SET @@session.sql_mode=0/*!*/;
SET @@session.auto_increment_increment=1, @@session.auto_increment_offset=1/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=45,@@session.collation_connection=45,@@session.collation_server=224/*!*/;
SET @@session.lc_time_names=0/*!*/;
SET @@session.collation_database=DEFAULT/*!*/;
BEGIN
/*!*/;
# at 951737076
#171128  7:26:14 server id 1  end_log_pos 951737196 	Query	thread_id=532858854	exec_time=0	error_code=0
use `haotaitai`/*!*/;
SET TIMESTAMP=1511825174/*!*/;
delete FROM `web_game_log` where addTime >1507770600
/*!*/;
# at 951737196
#171128  7:26:14 server id 1  end_log_pos 951737223 	Xid = 9563032332
COMMIT/*!*/;
# at 951737223
#171128  7:26:38 server id 1  end_log_pos 951737304 	Query	thread_id=532858861	exec_time=0	error_code=0
SET TIMESTAMP=1511825198/*!*/;
SET @@session.time_zone='SYSTEM'/*!*/;
BEGIN
/*!*/;
# at 951737304
#171128  7:26:38 server id 1  end_log_pos 951737432 	Query	thread_id=532858861	exec_time=0	error_code=0
SET TIMESTAMP=1511825198/*!*/;
delete FROM `web_gift_log` where addTime >1507770600
/*!*/;
# at 951737432
#171128  7:26:38 server id 1  end_log_pos 951737459 	Xid = 9563032355
COMMIT/*!*/;
# at 951737459
#171128  7:27:21 server id 1  end_log_pos 951737532 	Query	thread_id=532858865	exec_time=0	error_code=0
SET TIMESTAMP=1511825241/*!*/;
BEGIN
/*!*/;
# at 951737532
#171128  7:27:21 server id 1  end_log_pos 951737650 	Query	thread_id=532858865	exec_time=0	error_code=0
SET TIMESTAMP=1511825241/*!*/;
delete from `web_lottery` where addTime>1507770600
/*!*/;
# at 951737650
#171128  7:27:21 server id 1  end_log_pos 951737677 	Xid = 9563032379
COMMIT/*!*/;
# at 951737677
#171128  7:27:44 server id 1  end_log_pos 951737750 	Query	thread_id=532858869	exec_time=0	error_code=0
SET TIMESTAMP=1511825264/*!*/;
BEGIN
/*!*/;
# at 951737750
#171128  7:27:44 server id 1  end_log_pos 951737872 	Query	thread_id=532858869	exec_time=0	error_code=0
SET TIMESTAMP=1511825264/*!*/;
delete from `web_member_open` where addTime>1507770600
/*!*/;
# at 951737872
#171128  7:27:44 server id 1  end_log_pos 951737899 	Xid = 9563032403
COMMIT/*!*/;
# at 951737899
#171128  7:28:11 server id 1  end_log_pos 951737972 	Query	thread_id=532858875	exec_time=0	error_code=0
SET TIMESTAMP=1511825291/*!*/;
/*!\C utf8 *//*!*/;
SET @@session.character_set_client=33,@@session.collation_connection=33,@@session.collation_server=224/*!*/;
BEGIN
/*!*/;
# at 951737972
# at 951738082
#171128  7:28:11 server id 1  end_log_pos 951738109 	Xid = 9563032446
COMMIT/*!*/;
# at 951738109
#171128  7:28:24 server id 1  end_log_pos 951738182 	Query	thread_id=532858876	exec_time=0	error_code=0
SET TIMESTAMP=1511825304/*!*/;
/*!\C utf8mb4 *//*!*/;
SET @@session.character_set_client=45,@@session.collation_connection=45,@@session.collation_server=224/*!*/;
BEGIN
/*!*/;
# at 951738182
#171128  7:28:24 server id 1  end_log_pos 951738300 	Query	thread_id=532858876	exec_time=0	error_code=0
SET TIMESTAMP=1511825304/*!*/;
delete from `web_my_card` where addTime>1507770600
/*!*/;
# at 951738300
#171128  7:28:24 server id 1  end_log_pos 951738327 	Xid = 9563032495
COMMIT/*!*/;
# at 951738327
#171128  7:28:36 server id 1  end_log_pos 951738400 	Query	thread_id=532858876	exec_time=1	error_code=0
SET TIMESTAMP=1511825316/*!*/;
BEGIN
/*!*/;
# at 951738400
#171128  7:28:36 server id 1  end_log_pos 951738518 	Query	thread_id=532858876	exec_time=1	error_code=0
SET TIMESTAMP=1511825316/*!*/;
delete from `web_my_card` where addTime>1507770600
/*!*/;
# at 951738518
#171128  7:28:36 server id 1  end_log_pos 951738592 	Query	thread_id=532858876	exec_time=1	error_code=0
SET TIMESTAMP=1511825316/*!*/;
COMMIT
/*!*/;
# at 951738592
#171128  7:29:04 server id 1  end_log_pos 951738673 	Query	thread_id=532858881	exec_time=0	error_code=0
SET TIMESTAMP=1511825344/*!*/;
BEGIN
/*!*/;
# at 951738673
#171128  7:29:04 server id 1  end_log_pos 951738803 	Query	thread_id=532858881	exec_time=0	error_code=0
SET TIMESTAMP=1511825344/*!*/;
delete  from `web_my_coupon`  where addTime>1507770600
/*!*/;
# at 951738803
#171128  7:29:04 server id 1  end_log_pos 951738830 	Xid = 9563032617
COMMIT/*!*/;
# at 951738830
#171128  7:29:35 server id 1  end_log_pos 951738903 	Query	thread_id=532858886	exec_time=0	error_code=0
SET TIMESTAMP=1511825375/*!*/;
BEGIN
/*!*/;
# at 951738903
#171128  7:29:35 server id 1  end_log_pos 951739026 	Query	thread_id=532858886	exec_time=0	error_code=0
SET TIMESTAMP=1511825375/*!*/;
delete  from `web_not_winning` where addTime>1507770600
/*!*/;
# at 951739026
#171128  7:29:35 server id 1  end_log_pos 951739053 	Xid = 9563032663
COMMIT/*!*/;
# at 951739053
#171128  7:30:02 server id 1  end_log_pos 951739126 	Query	thread_id=532858892	exec_time=1	error_code=0
SET TIMESTAMP=1511825402/*!*/;
BEGIN
/*!*/;
# at 951739126
#171128  7:30:02 server id 1  end_log_pos 951739248 	Query	thread_id=532858892	exec_time=1	error_code=0
SET TIMESTAMP=1511825402/*!*/;
delete from `web_obtain_dice` where addTime>1507770600
/*!*/;
# at 951739248
#171128  7:30:02 server id 1  end_log_pos 951739275 	Xid = 9563032689
COMMIT/*!*/;
# at 951739275
#171128  7:30:35 server id 1  end_log_pos 951739348 	Query	thread_id=532858900	exec_time=0	error_code=0
SET TIMESTAMP=1511825435/*!*/;
BEGIN
/*!*/;
# at 951739348
#171128  7:30:35 server id 1  end_log_pos 951739464 	Query	thread_id=532858900	exec_time=0	error_code=0
SET TIMESTAMP=1511825435/*!*/;
delete from `web_share` where addTime>1507770600
/*!*/;
# at 951739464
#171128  7:30:35 server id 1  end_log_pos 951739491 	Xid = 9563032733
COMMIT/*!*/;
# at 951739491
#171128  7:31:34 server id 1  end_log_pos 951739572 	Query	thread_id=532858916	exec_time=0	error_code=0
SET TIMESTAMP=1511825494/*!*/;
BEGIN
/*!*/;
# at 951739572
#171128  7:31:34 server id 1  end_log_pos 951739715 	Query	thread_id=532858916	exec_time=0	error_code=0
SET TIMESTAMP=1511825494/*!*/;
delete from `web_synthesis_log` where addTime>'2017-10-12 09:10:00'
/*!*/;
# at 951739715
#171128  7:31:34 server id 1  end_log_pos 951739742 	Xid = 9563032854
COMMIT/*!*/;
DELIMITER ;
# End of log file
ROLLBACK /* added by mysqlbinlog */;
/*!50003 SET COMPLETION_TYPE=@OLD_COMPLETION_TYPE*/;
/*!50530 SET @@SESSION.PSEUDO_SLAVE_MODE=0*/;
