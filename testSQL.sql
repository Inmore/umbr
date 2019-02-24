create temp table users(id bigserial, group_id bigint);
insert into
   users(group_id) 
values (1), (1), (1), (2), (1), (3);

with help_table as 
(
   select
      - id + row_number() over (partition by group_id) as help_id,
      id,
      group_id 
   from
      users 
)
select
   min(id) as min_id,
   min(group_id) as group_id,
   count(id) as count 
from
   help_table 
group by
   help_id 
order by
   min_id
   