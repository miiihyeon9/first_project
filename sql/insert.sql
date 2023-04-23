INSERT INTO obj_list(
	obj_contents
	)VALUES(
	'목표를 설정하세요'
	);
	
INSERT INTO do_list(
	list_title
	,list_contents
	,ex_set
	,ex_num
	,ex_hour
	,ex_min
	,write_date
)VALUES(
	'상체'
	,'팔굽혀펴기'
	,'5'
	,'10'
	,'1'
	,'30'
	,NOW()
);

COMMIT;
	