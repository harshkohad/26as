User Management and RBAC migrations:
-------------------------------------

yii migrate --migrationPath=@mdm/admin/migrations

yii migrate --migrationPath=@yii/rbac/migrations

Core migrations:
------------------

yii migrate

Module Migrations:
------------------

yii migrate --migrationPath=modules/<module-id>/migrations

yii migrate --migrationPath=modules/teamAppraisal/migrations



Define Indexes:
-----------------
db.network_discovery_device_details_collection.files.createIndex({ "job_id": 1});
db.network_discovery_device_details_collection.files.createIndex({ "ip_address": 1});
db.network_discovery_device_details_collection.files.createIndex({ "status": 1});
db.network_discovery_device_details_collection.files.createIndex({ "discovery_status": 1});
db.network_discovery_device_details_collection.files.createIndex({ "inventory_status": 1});


db.job_master_collection.files.createIndex({ "action": 1});
db.job_master_collection.files.createIndex({ "status": 1});
db.job_master_collection.files.createIndex({ "user_id": 1});
db.job_master_collection.files.createIndex({ "created_at": 1});
db.job_master_collection.files.createIndex({ "modified_at": 1});

db.show_run_archive.files.createIndex({ "ip_address": 1});
db.show_run_archive.files.createIndex({ "md5sum": 1});
db.show_run_archive.files.createIndex({ "created_at": 1});
db.show_run_archive.files.createIndex({ "modified_at": 1});

db.network_discovery_crawling_index_collection.files.createIndex({ "crawling_key": 1});
db.network_discovery_crawling_index_collection.files.createIndex({ "ip_address": 1});

db.migration_l2vpn.createIndex({ "device_map_id": 1});
db.migration_l3vpn.createIndex({ "device_map_id": 1});
db.migration_logical.createIndex({ "device_map_id": 1});
db.migration_post_collection.createIndex({ "device_map_id": 1});
db.migration_pre_collection.createIndex({ "device_map_id": 1});