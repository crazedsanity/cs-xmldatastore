
-- 
-- Any API call must have a key in this table to even possibly be valid.
-- 
CREATE TABLE csxd_api_table (
	api_id serial NOT NULL PRIMARY KEY,
	auth_token_id int NOT NULL REFERENCES cswal_auth_token_table(auth_token_id),
	is_active bool NOT NULL DEFAULT TRUE
);


-- 
-- A "node" is a generic term for a server, daemon, program, or any system 
--	through which an API call is made.  Any program wishing to pull or push 
--	data must have an entry here.
-- 
CREATE TABLE csxd_node_table (
	node_id serial NOT NULL PRIMARY KEY,
	api_id int NOT NULL REFERENCES csxd_api_table(api_id)
);


-- 
-- List of stores where data items can be pushed to & pulled from.  Any API call 
--	is required to have a "store_key", which indicates which store data is being 
--	pulled from or pushed into.  When the store is full, no items can be added 
--	until it is emptied (or the size is increased)
-- 
CREATE TABLE csxd_store_table (
	store_id serial NOT NULL PRIMARY KEY,
	api_id int NOT NULL REFERENCES csxd_api_table(api_id),
	max_items int NOT NULL DEFAULT 10   					-- setting to 1 means only one item can exist
);


-- 
-- Links nodes to stores, indicating whether the given node can push or pull (or
--	both) for the given store.
-- 
CREATE TABLE csxd_node_to_store_table (
	node_to_store_id int NOT NULL PRIMARY KEY,
	node_id int NOT NULL REFERENCES csxd_node_table(node_id),
	store_id int NOT NULL REFERENCES csxd_store_table(store_id),
	can_pull bool NOT NULL DEFAULT FALSE,
	can_push bool NOT NULL DEFAULT FALSE
);


-- 
-- Where the actual data for a store is held in encrypted (and encoded) format.
--	The auth_data_hash option is for verifying that the data received matches 
--	what was sent (after decoding).  Supports md5 or SHA-1 hashes.
-- 
CREATE TABLE csxd_store_item_table (
	store_item_id serial NOT NULL PRIMARY KEY,
	store_id int NOT NULL REFERENCES csxd_store_table(store_id),
	auth_data_hash text DEFAULT NULL,
	creation timestamp NOT NULL DEFAULT NOW(),
	last_update timestamp,
	store_data text
);

